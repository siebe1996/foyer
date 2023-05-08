<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameCollection;
use App\Http\Resources\GameResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\WeaponCollection;
use App\Models\Game;
use App\Models\Weapon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GameWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $startedGames = Game::where('start_date', '<', Carbon::now())->where('end_date', '>', Carbon::now());
        $previousGames = Game::where('end_date', '<', Carbon::now());
        $startedGamesId = $startedGames->pluck('id');
        $previousGamesId = $previousGames->pluck('id');
        $startedGames = new GameCollection($startedGames->get());
        $previousGames =new GameCollection($previousGames->get());
        $gamesWithoutStarted = Game::whereNotIn('id', $startedGamesId);
        $otherGames = new GameCollection($gamesWithoutStarted->whereNotIn('id', $previousGamesId)->get());
        $buttons = ['create' => true, 'logout' => true];
        return view('home', ['previousGames' => $previousGames, 'startedGames' => $startedGames, 'otherGames' => $otherGames, 'buttons' => $buttons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $weapons = new WeaponCollection(Weapon::all());
        $buttons = ['create' => false, 'logout' => true];
        return view('create-game', ['weapons' => $weapons, 'buttons' => $buttons]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:games|max:125',
            'start_date' => 'required|before:end_date|after:now',
            'end_date' => 'required|after:start_date',
            'weapon_id' => 'required',
        ]);
        $game = new Game();
        $game->title = $request->title;
        $game->start_date = $request->start_date;
        $game->end_date = $request->end_date;
        $game->weapon_id = $request->weapon_id;
        $game->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $game = Game::findOrFail($id);
        $users = new UserCollection($game->usersWithPivot->all());
        $game = new GameResource($game);
        $buttons = ['create' => true, 'logout' => true];
        return view('game', ['game' => $game, 'users' => $users, 'buttons' => $buttons]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $game = new GameResource(Game::findOrFail($id));
        $weapons = new WeaponCollection(Weapon::all());
        $buttons = ['create' => true, 'logout' => true];
        return view('edit-game', ['game' => $game, 'weapons' => $weapons, 'buttons' => $buttons]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'start_date' => 'required|before:end_date|after:now',
            'end_date' => 'required|after:start_date',
            'weapon_id' => 'required',
        ]);
        $game = Game::findOrFail($id);
        $game->update(['start_date' => $request->start_date, 'end_date' => $request->end_date, 'weapon_id' => $request->weapon_id]);
        return redirect('games/'.$id);
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
    public function unpause($id)
    {
        $game = Game::findOrFail($id);
        $game->update(['active' => true]);
        return redirect('/');
    }

    /**
     * Changing the active state to 0.
     *
     * @param  int  $id
     */
    public function pause($id)
    {
        $game = Game::findOrFail($id);
        $game->update(['active' => false]);
        return redirect('/');
    }

    /**
     * Display the specified resource in leaderboard.
     *
     * @param  int  $id
     */
    public function leaderboard($id)
    {
        $game = Game::findOrFail($id);
        $users = $game->usersWithPivot;
        $alivePlayers = $users->where('pivot.alive', true);
        $alive = $alivePlayers->count();
        $death = $users->where('pivot.alive', false)->count();
        $alivePlayers = $alivePlayers->sortByDesc('pivot.kills')->all();
        $game = new GameResource($game);
        $alivePlayers = new UserCollection($alivePlayers);
        $buttons = ['create' => false, 'logout' => false];
        return view('leaderboard', ['game' => $game, 'users' => $alivePlayers, 'alive' => $alive, 'death' => $death, 'buttons' => $buttons]);
    }
}
