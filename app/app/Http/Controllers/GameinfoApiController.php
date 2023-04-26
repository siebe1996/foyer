<?php

namespace App\Http\Controllers;

use App\Models\Fooseballtable;
use App\Models\Game;
use App\Models\Gameinfo;
use Illuminate\Http\Request;

class GameinfoApiController extends Controller
{
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
     * @param  int  $tableId
     * @param  int  $teamId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $tableId, int $teamId)
    {
        $gameId = Fooseballtable::where('table_id', $tableId)->games()->where('active', true)
            ->pluck('id')->firstOrFail();

        $gameInfo = Gameinfo::where('team_id', $teamId)
            ->where('game_id', $gameId)->firstOrFail();

        $scoreChange = $request->input('score_change');
        if ($scoreChange !== 1 && $scoreChange !== -1) {
            return response()->json(['error' => 'Invalid score change.'], 400);
        }

        $gameInfo->goals += $scoreChange;
        $gameInfo->save();
        return response()->json(['message' => 'Score updated successfully.']);
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
