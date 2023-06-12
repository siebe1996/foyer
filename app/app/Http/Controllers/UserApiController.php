<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Game;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *     path="/api/users",
     *     summary="Get all users except the authenticated user",
     *     tags={"Users"},
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
     *                     @OA\Property(property="name", type="string", example="John Doe")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *     security={{"sanctum":{}}}
     * )
     */
    public function index()
    {
        $id = Auth::id();
        $users = User::where('id', '!=', $id)->get()->map(function ($user) {
            return ['id' => $user->id, 'name' => $user->full_name];
        });
        return response()->json(['data' => $users]);
    }

    /**
     * Store a newly created resource in storage and creates a team.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Post(
     *     path="/api/register",
     *     summary="User Registration with first team creation",
     *     description="Register a new user",
     *     operationId="registerUser",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="User data",
     *         @OA\JsonContent(
     *             @OA\Property(property="first_name", type="string", example="John"),
     *             @OA\Property(property="last_name", type="string", example="Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="secret"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User registered successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User registered successfully and a team has been created.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object", example={"email": {"The email field is required."}})
     *         )
     *     ),
     * )
     */

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::findOrFail(1);
        $user->roles()->attach($role);

        // Perform login
        $credentials = $request->only('email', 'password');
        $loginController = new LoginController();
        $loginResponse = $loginController->login($request);

        if ($loginResponse->getStatusCode() === 200) {

            // Create team
            $teamRequest = new Request([
                'name' => $request->first_name.' '.$request->last_name,
            ]);
            $teamApiController = new TeamApiController();
            $teamResponse = $teamApiController->store($teamRequest);

            if ($teamResponse->getStatusCode() === 200) {
                // Create new response with message
                $newResponse = response()->json(['message' => 'User registered successfully and a team has been created']);
                return $newResponse;
            } else {
                return response()->json(['message' => 'A problem occurred while creating the team'], 401);
            }
        } else {
            return response()->json(['message' => 'A problem occurred during login'], 401);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('show-user', $id);
        $user = new UserResource(User::with('roles')->findOrFail($id));
        return response(['data' => $user], 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function allUsers(Request $request)
    {
        //Gate::authorize('show-all-users');

        $users = User::all();
        return response(['data' => $users], 200)
            ->header('Content-Type', 'application/json');

    }

    /**
     * Display loggedin user.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *     path="/api/profile",
     *     summary="Get logged-in user profile",
     *     tags={"Users"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="id",
     *                     type="integer",
     *                     example=1
     *                 ),
     *                 @OA\Property(
     *                     property="first_name",
     *                     type="string",
     *                     example="John"
     *                 ),
     *                 @OA\Property(
     *                     property="last_name",
     *                     type="string",
     *                     example="Doe"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     example="johndoe@example.com"
     *                 ),
     *                 @OA\Property(
     *                     property="total_wins",
     *                     type="integer",
     *                     example=0
     *                 ),
     *                 @OA\Property(
     *                     property="games_played",
     *                     type="integer",
     *                     example=1
     *                 ),
     *                 @OA\Property(
     *                     property="roles",
     *                     type="array",
     *                     @OA\Items(
     *                         @OA\Property(
     *                             property="id",
     *                             type="integer",
     *                             example=1
     *                         ),
     *                         @OA\Property(
     *                             property="title",
     *                             type="string",
     *                             example="player"
     *                         )
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="teams",
     *                     type="object",
     *                     @OA\Property(
     *                         property="as_player1",
     *                         type="array",
     *                         @OA\Items()
     *                     ),
     *                     @OA\Property(
     *                         property="as_player2",
     *                         type="array",
     *                         @OA\Items(
     *                             @OA\Property(
     *                                 property="id",
     *                                 type="string",
     *                                 example="ut"
     *                             ),
     *                             @OA\Property(
     *                                 property="player1_id",
     *                                 type="integer",
     *                                 example=3
     *                             ),
     *                             @OA\Property(
     *                                 property="player2_id",
     *                                 type="integer",
     *                                 example=1
     *                             ),
     *                             @OA\Property(
     *                                 property="total_wins",
     *                                 type="integer",
     *                                 example=3
     *                             ),
     *                             @OA\Property(
     *                                 property="games_played",
     *                                 type="integer",
     *                                 example=9
     *                             )
     *                         )
     *                     )
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="admin",
     *                 type="boolean",
     *                 description="Indicates if the user is an administrator"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     )
     * )
     */
    public function profile()
    {
        $id = Auth::id();
        $u = User::with('roles')->findOrFail($id);
        $user = new UserResource(User::with('roles')->with('teamsAsPlayer1')->with('teamsAsPlayer2')->findOrFail($id));
        return response()->json(['data' => $user, 'admin' => $u->hasRole('administrator')]);
    }
}
