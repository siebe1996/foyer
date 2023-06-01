<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeamCollection;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *     path="/api/teams",
     *     summary="Get teams excluding the authenticated player",
     *     tags={"Teams"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Team1")
     *                 ),
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=2),
     *                     @OA\Property(property="name", type="string", example="Team2")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     )
     * )
     */
    public function index()
    {
        $id = Auth::id();
        $teams = Team::where('player1_id', '!=', $id)->where('player2_id', '!=', $id)->get()->map(function ($team){
            return ['id' => $team->id, 'name' => $team->name];
        });
        return response()->json(['data' => $teams]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Post(
     *     path="/api/teams",
     *     summary="Create a new team",
     *     tags={"Teams"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="id", type="integer", format="int64", nullable=true, description="The optional ID of the second player")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Team created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Team was made successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="array", @OA\Items(type="string"))
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'player2_id' => 'exists:users,id|integer|nullable',
        ]);
        $id = Auth::id();
        $player1 = User::findOrFail($id);
        $team = new Team();
        $team->name = $request->name;
        $team->player1()->associate($player1);
        try{
            $player2 = User::findOrFail($request->id);
            $team->player2()->associate($player2);
        }catch (ModelNotFoundException){

        } finally {
            $team->save();
            return response()->json(['message' => 'Team was made successfully']);
        }
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

    /**
     * Display loggedin user teams.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *     path="/api/teams/my",
     *     summary="Get teams of the authenticated player",
     *     tags={"Teams"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Team1"),
     *                     @OA\Property(property="player1_id", type="integer", example=1),
     *                     @OA\Property(property="player2_id", type="integer", example=7),
     *                     @OA\Property(property="total_wins", type="integer", example=3),
     *                     @OA\Property(property="games_played", type="integer", example=9),
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     )
     * )
     */
    public function myTeams()
    {
        $id = Auth::id();
        $teams = Team::where('player1_id', $id)->orWhere('player2_id', $id)->get();
        $teams = new TeamCollection($teams);
        return response()->json(['data' => $teams]);
    }
}
