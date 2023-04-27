<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameinfoResource;
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
        $gameId = Fooseballtable::findOrFail($tableId)->games()->where('active', true)
            ->pluck('id')->firstOrFail();

        $gameInfo = Game::where('id', $gameId)
            ->whereHas('teams', function ($q) use ($teamId) {
                $q->where('teams.id', $teamId);
            })->with(['teamsWithPivot' => function ($query) use ($teamId) {
                $query->where('teams.id', $teamId);
            }])->first();
        $goals = $gameInfo->teamsWithPivot->first()->pivot->goals;

        $scoreChange = $request->input('score_change');
        if ($scoreChange !== 1 && $scoreChange !== -1) {
            return response()->json(['error' => 'Invalid score change.'], 400);
        }
        $goals += $scoreChange;
        $gameInfo->teamsWithPivot->first()->pivot->update(['goals' => $goals]);

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
