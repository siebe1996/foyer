<?php

namespace App\Http\Controllers;

use App\Http\Resources\FooseballtableCollection;
use App\Http\Resources\FooseballtableResource;
use App\Http\Resources\ScoreCollection;
use App\Http\Resources\ScoreResource;
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
     * Start a game.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *     path="api/tables/{id}/start",
     *     summary="Start game",
     *     tags={"Games"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the foosball table",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Game started successfully",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Game started successfully."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=208,
     *         description="Game is already running",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Game is already running."
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
     *                 example="Foosball table not found."
     *             )
     *         )
     *     )
     * )
     */
    public function start(int $id){
        $table = Fooseballtable::findOrFail($id);
        try{
            Game::where('fooseballtable_id', $id)->where('active', true)->firstOrFail();
        }catch (ModelNotFoundException){
            try{
                //wat als een game wordt gemaakt en niet gestart?
                $game = Game::where('fooseballtable_id', $id)->where('start_date', null)->firstOrFail();
                $game->active = true;
                $game->start_date = Carbon::now()->format('Y-m-d H:i:s');
                $game->save();
                return response()->json(['message' => 'Game started succesfully']);
            }catch(ModelNotFoundException){
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

                return response()->json(['message' => 'Anon Game started succesfully']);
            }
        }
        return response()->json(['message' => 'Game is already running'], 208);

        /*$player1 = User::where('email', 'anon1@example.com')->firstOrFail(); //toDo research firstOrCreate
        $player2 = User::where('email', 'anon2@example.com')->firstOrFail();

        $team1id = $player1->teamsAsPlayer1()->pluck('id')->firstOrFail(); //toDo research firstOrCreate
        */
    }

    /**
     * Stop a game.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *     path="api/tables/{id}/end",
     *     summary="End game",
     *     tags={"Games"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the foosball table",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Game ended successfully",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Game ended successfully."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=208,
     *         description="No Game is running",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="No Game is running."
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
     *                 example="Game not found."
     *             )
     *         )
     *     )
     * )
     */
    public function end(int $id){
        try{
            Game::where('fooseballtable_id', $id)->where('active', true)->firstOrFail();
        }catch (ModelNotFoundException){
            return response()->json(['message' => 'No Game is running'],208);
        }
        $game = Game::where('fooseballtable_id', $id)->where('active', true)->firstOrFail();
        $teams = $game->teams()->get();
        $scoreTeam1 = $this->getGoalsTeams($game->id, $teams[0]->id);
        $scoreTeam2 = $this->getGoalsTeams($game->id, $teams[1]->id);
        if($scoreTeam1 > $scoreTeam2){
            $winner = $teams[0];
            $teams[0]->total_wins = $teams[0]->total_wins+1;
        }
        else{
            $winner = $teams[1];
            $teams[1]->total_wins = $teams[1]->total_wins+1;
        }
        $teams[0]->games_played = $teams[0]->games_played+1;
        $teams[1]->games_played = $teams[1]->games_played+1;
        $game->active = false;
        $game->end_date = Carbon::now()->format('Y-m-d H:i:s');
        $game->winner()->associate($winner);
        $game->save();
        $teams[0]->save();
        $teams[1]->save();

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
     * Get a list of fooseball tables.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *     path="api/tables",
     *     operationId="getFooseballTables",
     *     tags={"Tables"},
     *     security={{"sanctum":{}}},
     *     summary="Get a list of fooseball tables",
     *     description="Returns a list of fooseball tables",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         example=1
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Table1"
     *                     ),
     *                     @OA\Property(
     *                         property="unique_code",
     *                         type="string",
     *                         example="ABCD"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        return response()->json(['data' => new FooseballtableCollection(Fooseballtable::get())]);
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
     * Get the details of a fooseball table.
     *
     * @param int $id The ID of the fooseball table
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *     path="api/tables/{id}",
     *     operationId="getFooseballTable",
     *     tags={"Tables"},
     *     security={{"sanctum":{}}},
     *     summary="Get the details of a fooseball table",
     *     description="Returns the details of a fooseball table",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the fooseball table",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             example=1
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
     *                     example="Table1"
     *                 ),
     *                 @OA\Property(
     *                     property="unique_code",
     *                     type="string",
     *                     example="ABCD"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Fooseball table not found",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Fooseball table doesn't exist"
     *             )
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        try{
            $table = Fooseballtable::findOrFail($id);
            return response()->json(['data' => new FooseballtableResource($table)]);
        }catch(ModelNotFoundException){
            return response()->json(['message' => "Fooseball table doesn't exist"], 404);
        }
    }

    /**
     * Get the scores for a specific table.
     *
     * @param int $id The ID of the table.
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @OA\Get(
     *     path="api/tables/{id}/scores",
     *     summary="Get scores for a table",
     *     tags={"Tables"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         description="The ID of the table",
     *         in="path",
     *         required=true,
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
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(
     *                         property="team_name",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="game_name",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="start_time",
     *                         type="datetime"
     *                     ),
     *                     @OA\Property(
     *                         property="table_id",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="goals",
     *                         type="integer"
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No game running on this table",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string"
     *             )
     *         )
     *     )
     * )
     */
    public function showScores($id)
    {
        try {
            $game = Game::Where('fooseballtable_id', $id)->Where('active', true)->firstOrFail();
            $gameInfo = $game->teamsWithPivot()->get();
            $score = $gameInfo->map(function ($item) use ($game, $id){
                $data = ['game_name' => $game->name, 'start_time' => $game->start_date, 'team_name' => $item->name, 'table_id' => $id, 'goals' => $item->pivot->goals];
                return new ScoreResource((object)$data);
            });
            return response()->json(['data' => $score]);
        }catch(ModelNotFoundException){
            return response()->json(['message' => "No game running on this table"], 404);
        }
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
