<?php

namespace App\Http\Controllers;

use App\Models\Fooseballtable;
use App\Models\Game;
use App\Models\Gameinfo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TableApiController extends Controller
{
    /**
     * Start an anonymous game.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function start(int $id){
        $table = Fooseballtable::findOrFail($id);

        $player1 = User::where('email', 'anon1@example.com')->firstOrFail();
        $player2 = User::where('email', 'anon2@example.com')->firstOrFail();

        $team1id = $player1->teamsAsPlayer1()->pluck('id')->firstOrFail();
        $team2id = $player2->teamsAsPlayer1()->pluck('id')->firstOrFail();
        $teamIds = [$team1id, $team2id];

        $game = new Game;
        $game->name = 'anon';
        $game->active = true;
        $game->start_date = Carbon::now()->format('Y-m-d H:i:s');
        $game->fooseballtable()->associate($table);
        $game->save();

        $game->teams()->attach($teamIds); //attach() for new, sync() for adding

        return response()->json(['message' => 'Game started succesfully']);
        /*$game = Game::create([
            'name' => 'anon',
            'active' => true,
            'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'fooseballtable_id' => $id,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);*/
    }

    /**
     * Stop an anonymous game.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function end(int $id){
        $player1 = User::where('email', 'anon1@example.com')->firstOrFail();
        $player2 = User::where('email', 'anon2@example.com')->firstOrFail();

        $team1 = $player1->teamsAsPlayer1()->firstOrFail();
        $team2 = $player2->teamsAsPlayer1()->firstOrFail();

        $game = Game::where('fooseballtable_id', $id)->firstOrFail();

        $scoreTeam1 = Gameinfo::where('team_id', $team1->id)->where('game_id', $game->id)
            ->pluck('goals')->firstOrFail();
        $scoreTeam2 = Gameinfo::where('team_id', $team2->id)->where('game_id', $game->id)
            ->pluck('goals')->firstOrFail();
        $winner = $scoreTeam1 > $scoreTeam2 ? $team1 : $team2;

        $game->active = false;
        $game->end_date = Carbon::now()->format('Y-m-d H:i:s');
        $game->winner = $winner;
        $game->save();

        return response()->json(['message' => 'Game ended succesfully']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
