<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameCollection;
use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GameWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $startedGames = Game::where('start_date', '<', Carbon::now())->where('end_date', '>', Carbon::now());
        $startedGamesId = $startedGames->pluck('id');
        $startedGames = new GameCollection($startedGames->get());
        $otherGames = new GameCollection(Game::whereNotIn('id', $startedGamesId)->get());
        $previousGames = new GameCollection(Game::where('end_date', '<', Carbon::now())->get());
        $buttons = ['create' => true, 'logout' => true];
        return view('home', ['previousGames' => $previousGames, 'startedGames' => $startedGames, 'otherGames' => $otherGames, 'buttons' => $buttons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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

    /**
     * Changing the active state to 1.
     *
     * @param  int  $id
     */
    public function start($id) //toDo complete the start game function
    {
        $game = Game::findOrFail($id);
    }

    /**
     * Changing the active state to 0.
     *
     * @param  int  $id
     */
    public function pause($id) //toDo complete the pause game function
    {
        $game = Game::findOrFail($id);
    }
}
