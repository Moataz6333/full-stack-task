<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
      public function admin_login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
            if($user->role !== 'admin') {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'user'  => UserResource::make($user),
            'token' => $token,
        ]);
    }
      public function user_login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
           if($user->role !=='user'){
              return response()->json(['message' => 'Unauthorized'], 403);
           }
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'user'  => UserResource::make($user),
            'token' => $token,
        ]);
    }

    // logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
