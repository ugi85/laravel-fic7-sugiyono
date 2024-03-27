<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        $user = User::where('email',$request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['email incorrect']
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['password incorrect']
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => new UserResource($user),
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required',
            'name' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => new UserResource($user),
        ]);
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();


        if (!$token) {
            return response()->json(['message' => 'Token not provided'], 401);
        }

        if (!$request->user()->tokenCan($token)) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        $request->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function updateFcmToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required'
        ]);

        $user = $request->user();
        $user->fcm_token = $request->fcm_token;
        $user->save();

        return response()->json([
            'message' => 'fcm token updated successfully',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
