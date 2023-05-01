<?php

namespace App\Http\Controllers;

use App\Http\Resources\FooseballtableResource;
use App\Models\Fooseballtable;
use App\Models\Game;
use App\Models\Gameinfo;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

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
        try{
            Game::where('fooseballtable_id', $id)->where('active', true)->firstOrFail();
        }catch (ModelNotFoundException){
            $team1id = Team::where('name', 'anonteam1')->pluck('id')->firstOrFail();
            $team2id = Team::where('name', 'anonteam2')->pluck('id')->firstOrFail();
            $teamIds = [$team1id, $team2id];

            $game = new Game;
            $game->name = 'anon';
            $game->active = true;
            $game->start_date = Carbon::now()->format('Y-m-d H:i:s');
            $game->fooseballtable()->associate($table);
            $game->save();

            $game->teams()->attach($teamIds); //attach() for new, sync() for adding

            return response()->json(['message' => 'Game started succesfully']);
        }
        return response()->json(['message' => 'Game is already running']);

        /*$player1 = User::where('email', 'anon1@example.com')->firstOrFail(); //toDo research firstOrCreate
        $player2 = User::where('email', 'anon2@example.com')->firstOrFail();

        $team1id = $player1->teamsAsPlayer1()->pluck('id')->firstOrFail(); //toDo research firstOrCreate
        */
    }

    /**
     * Stop an anonymous game.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function end(int $id){
        $team1 = Team::where('name', 'anonteam1')->firstOrFail();
        $team2 = Team::where('name', 'anonteam2')->firstOrFail();
        try{
            Game::where('fooseballtable_id', $id)->where('active', true)->firstOrFail();
        }catch (ModelNotFoundException){
            return response()->json(['message' => 'No Game is running']);
        }
        $game = Game::where('fooseballtable_id', $id)->where('active', true)->firstOrFail();

        $scoreTeam1 = $this->getGoalsTeams($game->id, $team1->id);
        $scoreTeam2 = $this->getGoalsTeams($game->id, $team2->id);

        $winner = $scoreTeam1 > $scoreTeam2 ? $team1 : $team2;

        $game->active = false;
        $game->end_date = Carbon::now()->format('Y-m-d H:i:s');
        $game->winner()->associate($winner);
        $game->save();

        return response()->json(['message' => 'Game ended succesfully']);
    }

    /**
     * Helper function that returns the amount of goals
     *
     * @param  int  $gameId
     * @param  int  $teamId
     * @return integer
     */
    public function getGoalsTeams(int $gameId, int $teamId){
        $gameInfo = Game::where('id', $gameId)
            ->whereHas('teams', function ($q) use ($teamId) {
                $q->where('teams.id', $teamId);
            })->with(['teamsWithPivot' => function ($query) use ($teamId) {
                $query->where('teams.id', $teamId);
            }])->first();
        return $gameInfo->teamsWithPivot->first()->pivot->goals;
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
