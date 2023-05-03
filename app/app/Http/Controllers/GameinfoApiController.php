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
    /**
     * @OA\Patch(
     * path="api/table/{tableId}/team/{teamId}",
     * operationId="updateGameinfo",
     * tags={"Gameinfo"},
     * summary="Update the specified resource in storage",
     * description="Update the specified resource in storage",
     *     @OA\Parameter(
     *          name="tableId",
     *          description="Table id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="teamId",
     *          description="Team id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="score_change", type="integer", example=1),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Score updated successfully.")
     *          )
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Invalid score change.")
     *          )
     *      ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function update(Request $request, int $tableId, int $teamId)
    {
        $request->validate([
            'score_change' => 'required|numeric',
        ]);
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
