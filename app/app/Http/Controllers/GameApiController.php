<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameCollection;
use App\Http\Resources\GameResource;
use App\Http\Resources\UserCollection;
use App\Models\Fooseballtable;
use App\Models\Game;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class GameApiController extends Controller
{
    /**
     * Get a list of games.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *     path="/api/games",
     *     summary="Get a list of games",
     *     tags={"Games"},
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
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Game1"),
     *                     @OA\Property(property="active", type="boolean", example=true),
     *                     @OA\Property(property="start_date", type="string", format="date-time", example="2023-05-09T05:06:41.000000Z"),
     *                     @OA\Property(property="end_date", type="string", format="date-time", example="2023-05-10T03:28:53.000000Z"),
     *                     @OA\Property(property="competition_id", type="integer", example=4),
     *                     @OA\Property(property="winner_id", type="integer", example=10),
     *                     @OA\Property(property="fooseballtable_id", type="integer", example=2),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2023-05-12T17:45:16.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2023-05-12T17:45:16.000000Z"),
     *                 ),
     *             ),
     *         ),
     *     ),
     * )
     */
    public function index(){
        $games = new GameCollection(Game::orderBy('start_date', 'desc')->get());
        return response()->json(['data' => $games]);
    }

    /**
     * Get games with teams and scores.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     *
     * @oa\Get(
     *     path="/api/games/scores",
     *     tags={"Games"},
     *     summary="Get games with teams and scores",
     *     security={{"sanctum":{}}},
     *     operationId="showAllScores",
     *     @oa\Response(
     *         response=200,
     *         description="Successful operation",
     *         @oa\JsonContent(
     *             @oa\Property(property="data", type="array",
     *                 @oa\Items(
     *                     @oa\Property(property="id", type="integer"),
     *                     @oa\Property(property="name", type="string"),
     *                     @oa\Property(property="active", type="boolean"),
     *                     @OA\Property(
     *                         property="start_date",
     *                         type="datetime"
     *                     ),
     *                     @OA\Property(
     *                         property="end_date",
     *                         type="datetime"
     *                     ),
     *                     @oa\Property(property="unique_code", type="string"),
     *                     @oa\Property(property="teams", type="array",
     *                         @oa\Items(
     *                             @oa\Property(property="id", type="integer"),
     *                             @oa\Property(property="name", type="string"),
     *                             @oa\Property(property="goals", type="integer")
     *                         )
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @oa\Response(response=500, description="Internal server error")
     * )
     */
    public function showAllScores()
    {
        $games = Game::orderBy('start_date', 'desc')->with('teamsWithPivot')->get();

        $data = $games->map(function ($game) {
            return [
                'id' => $game->id,
                'name' => $game->name,
                'active' => $game->active,
                'start_date' => $game->start_date,
                'end_date' => $game->end_date,
                'unique_code' => $game->fooseballtable->unique_code,
                'teams' => $game->teamsWithPivot->map(function ($team) {
                    return [
                        'id' => $team->id,
                        'name' => $team->name,
                        'goals' => $team->pivot->goals ?? 0,
                    ];
                }),
            ];
        });
        return response()->json(['data' => $data]);
    }
    /**
     * Store a new game.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Post(
     *     path="/api/games",
     *     summary="Store a new game",
     *     tags={"Games"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"name", "unique_code", "team1_id", "team2_id"},
     *                 @OA\Property(property="name", type="string", example="Game 1"),
     *                 @OA\Property(property="unique_code", type="string", example="ABCD"),
     *                 @OA\Property(property="team1_id", type="integer", example=1),
     *                 @OA\Property(property="team2_id", type="integer", example=2),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Game made successfully"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Table doesn't exist"),
     *         ),
     *     ),
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'unique_code' => 'required|string|size:4|exists:fooseballtables',
            'team1_id' => 'exists:teams,id|integer',
            'team2_id' => 'exists:teams,id|integer',
        ]);

        try{
            $table = Fooseballtable::where('unique_code', $request->unique_code)->firstOrFail();
            $game = new Game();
            $game->name = $request->name;
            $game->active = false;
            $game->fooseballtable()->associate($table);
            $game->save();
            $game->teams()->attach([$request->team1_id, $request->team2_id]);

            return response()->json(['message' => 'Game made successfully']);
        }catch(ModelNotFoundException){
            return response()->json(['message' => 'Table doesnt exist'], 422);
        }
    }

    /**
     * Get a game by ID.
     *
     * @param int $id Game ID
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *     path="/api/games/{id}",
     *     operationId="getGameById",
     *     tags={"Games"},
     *     security={{"sanctum":{}}},
     *     summary="Get a game by ID",
     *     description="Returns a game based on the provided ID",
     *     @OA\Parameter(
     *         name="id",
     *         description="Game ID",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="id",
     *                     type="integer",
     *                     example=1
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     example="inventore"
     *                 ),
     *                 @OA\Property(
     *                     property="active",
     *                     type="boolean",
     *                     example=true
     *                 ),
     *                 @OA\Property(
     *                     property="start_date",
     *                     type="string",
     *                     format="date-time",
     *                     example="2023-05-09T05:06:41.000000Z"
     *                 ),
     *                 @OA\Property(
     *                     property="end_date",
     *                     type="string",
     *                     format="date-time",
     *                     example="2023-05-10T03:28:53.000000Z"
     *                 ),
     *                 @OA\Property(
     *                     property="competition_id",
     *                     type="integer",
     *                     example=4
     *                 ),
     *                 @OA\Property(
     *                     property="winner_id",
     *                     type="integer",
     *                     example=10
     *                 ),
     *                 @OA\Property(
     *                     property="fooseballtable_id",
     *                     type="integer",
     *                     example=2
     *                 ),
     *                 @OA\Property(
     *                     property="created_at",
     *                     type="string",
     *                     format="date-time",
     *                     example="2023-05-12T17:45:16.000000Z"
     *                 ),
     *                 @OA\Property(
     *                     property="updated_at",
     *                     type="string",
     *                     format="date-time",
     *                     example="2023-05-12T17:45:16.000000Z"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Game not found",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Game doesn't exist"
     *             )
     *         )
     *     )
     * )
     */
    public function show($id){
        try{
            $game = Game::findOrFail($id);
            return response()->json(['data' => new GameResource($game)]);
        }catch(ModelNotFoundException){
            return response()->json(['message' => "Game doesn't exist"], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $gameId)
    {
        /*
        $request->validate([
            'gameId' => 'required'
        ]);
        $userId = Auth::id();
        $gameUser = Game::where('id', $gameId)->users()->attach($userId)->with('usersWithPivot')->get();
        return response(['data' => $gameUser], 200)
            ->header('Content-Type', 'application/json');
        */
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
     * Display all current games of user.
     *
     * @return \Illuminate\Http\Response
     */
    public function current(){
        $userId = Auth::id();

        $activeGamesWithUser = new GameCollection(Game::where('active', true)
            ->whereHas('users', function ($q) use ($userId){
                $q->where('users.id', '=', $userId);
            })->get());

        return response(['data' => ['current_games' => $activeGamesWithUser]], 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Display the games associated with the authenticated player.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *     path="/api/games/my",
     *     summary="Get the games associated with the authenticated player",
     *     tags={"Games"},
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Game1"),
     *                     @OA\Property(property="active", type="boolean", example=true),
     *                     @OA\Property(property="start_date", type="string", format="date-time", example="2023-05-09T05:06:41.000000Z"),
     *                     @OA\Property(property="end_date", type="string", format="date-time", example="2023-05-10T03:28:53.000000Z"),
     *                     @OA\Property(property="competition_id", type="integer", example=4),
     *                     @OA\Property(property="winner_id", type="integer", example=10),
     *                     @OA\Property(property="fooseballtable_id", type="integer", example=2),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2023-05-12T17:45:16.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2023-05-12T17:45:16.000000Z")
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
    public function myGames()
    {
        $id = Auth::id();
        $games = Game::orderBy('start_date', 'desc')->whereHas('teams', function ($q) use ($id){
            $q->where('teams.player1_id', $id)->orWhere('teams.player2_id', $id);
        })->get();
        $games = new GameCollection($games);
        return response()->json(['data' => $games]);
    }

    /**
     * Retrieve scores for the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *     path="/api/games/my/scores",
     *     summary="Get scores for the authenticated user",
     *     tags={"Games"},
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(
     *                 @OA\Property(property="id", type="integer", example="1"),
     *                 @OA\Property(property="name", type="string", example="Game 1"),
     *                 @OA\Property(property="active", type="boolean", example="true"),
     *                 @OA\Property(property="start_date", type="string", format="datetime", example="2023-05-15 10:00:00"),
     *                 @OA\Property(property="end_date", type="string", format="datetime", example="2023-05-15 11:00:00"),
     *                 @OA\Property(property="unique_code", type="string", example="ABC123"),
     *                 @OA\Property(property="teams", type="array", @OA\Items(
     *                     @OA\Property(property="id", type="integer", example="1"),
     *                     @OA\Property(property="name", type="string", example="Team A"),
     *                     @OA\Property(property="goals", type="integer", example="2")
     *                 ))
     *             ))
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     )
     * )
     */
    public function myScores(){
        $id = Auth::id();
        $games = Game::orderBy('start_date', 'desc')->whereHas('teams', function ($q) use ($id){
            $q->where('teams.player1_id', $id)->orWhere('teams.player2_id', $id);
        })->with('teamsWithPivot')->get();

        $data = $games->map(function ($game) {
            return [
                'id' => $game->id,
                'name' => $game->name,
                'active' => $game->active,
                'start_date' => $game->start_date,
                'end_date' => $game->end_date,
                'unique_code' => $game->fooseballtable->unique_code,
                'teams' => $game->teamsWithPivot->map(function ($team) {
                    return [
                        'id' => $team->id,
                        'name' => $team->name,
                        'goals' => $team->pivot->goals ?? 0,
                    ];
                }),
            ];
        });
        return response()->json(['data' => $data]);
    }
}
