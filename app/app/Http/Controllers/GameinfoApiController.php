<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameinfoResource;
use App\Models\Fooseballtable;
use App\Models\Game;
use App\Models\Gameinfo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
     *
     * @OA\Patch(
     *     path="/api/tables/{tableId}/teams/{teamId}",
     *     summary="Update score",
     *     tags={"Gameinfo"},
     *     @OA\Parameter(
     *         name="tableId",
     *         in="path",
     *         description="ID of the foosball table",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="teamId",
     *         in="path",
     *         description="ID of the team",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Score change",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="score_change",
     *                 type="integer",
     *                 example=1
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Score updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Score updated successfully."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="error",
     *                 type="string",
     *                 example="Invalid score change."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="error",
     *                 type="string",
     *                 example="No game is active on this table."
     *             )
     *         )
     *     )
     * )
     */
    public function update(Request $request, int $tableId, int $teamId)
    {
        $request->validate([
            'score_change' => 'required|numeric',
        ]);
        try{
            Fooseballtable::findOrFail($tableId)->games()->where('active', true)
                ->pluck('id')->firstOrFail();
        }catch (ModelNotFoundException){
            return response()->json(['error' => 'No game is active on this table.'], 400);
        }
        $gameId = Fooseballtable::findOrFail($tableId)->games()->where('active', true)
            ->pluck('id')->firstOrFail();
        try{
            Game::where('id', $gameId)
                ->whereHas('teams', function ($q) use ($teamId) {
                    $q->where('teams.id', $teamId);
                })->with(['teamsWithPivot' => function ($query) use ($teamId) {
                    $query->where('teams.id', $teamId);
                }])->firstOrFail();
        }catch (ModelNotFoundException){
            return response()->json(['error' => 'This team isnt playing this game'], 400);
        }

        $gameInfo = Game::where('id', $gameId)
            ->whereHas('teams', function ($q) use ($teamId) {
                $q->where('teams.id', $teamId);
            })->with(['teamsWithPivot' => function ($query) use ($teamId) {
                $query->where('teams.id', $teamId);
            }])->firstOrFail();
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
