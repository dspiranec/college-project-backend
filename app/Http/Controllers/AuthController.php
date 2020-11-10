<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Http\Requests\RegisterRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register',]]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Email or password doesn\'t exist.'], 401);
        }

        return $this->respondWithToken($token);
    }
    
    public function register(RegisterRequest $request){

        $role = Role::where('name', 'user')->first();

        $user = User::create($request->all());

        $userId = $user->id;

        self::giveUser($userId);
        
        return response() ->json(['success' => 'U have successfully registered!'], 201);
        //return $this->login($request);
    }

    public function giveUser($userId){
        $user = User::where('id', $userId)->firstOrFail();

        $userRole = Role::where('name', 'user')->firstOrFail();

        $user->roles()->attach($userRole->id);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = auth()->user();
        
        //return response()->json($user);
        return $user;
    }

    public function currentRole()
    {
        $userId = auth()->user()->id;
        $user = User::where('id', $userId)->with('roles')->first();
        $currentRole = $user->roles->first()->name;

        return $currentRole;
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'userId' => auth()->user()->id,
            'role' => self::currentRole(),
        ]);
    }
}
