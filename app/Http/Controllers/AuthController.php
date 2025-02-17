<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        //vcr
        $request->validate([
            'FirstName' => 'required|string|max:50',
            'LastName' => 'required|string|max:50',
            'Email' => 'required|string|email|max:100|unique:users',
            'PasswordHash' => 'required|string|min:8',
            'PhoneNumber' => 'sometimes|string|max:15'
        ]);

        $user = User::create([
            'FirstName' => $request->FirstName,
            'LastName' => $request->LastName,
            'Email' => $request->Email,
            'PasswordHash' => Hash::make($request->PasswordHash),
            'PhoneNumber' => $request->PhoneNumber
        ]);

        event(new Registered($user));

        return response()->json([
            'message' => 'Registration successful! Please check your email for verification.',
            'token' => $user->createToken('auth_token')->plainTextToken
        ]);
    }

// app/Http/Controllers/AuthController.php
public function verifyEmail(Request $request, $id, $hash)
{
    $user = User::findOrFail($id);


    if (sha1($user->Email) !== $hash) {
        return response()->json(['message' => 'رابط التفعيل غير صالح'], 400);
    }

    if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }

    return response()->json(['message' => 'تم تفعيل الإيميل بنجاح!']);
}

    public function login(Request $request)
    {
        $request->validate([
            'Email' => 'required|string|email',
            'PasswordHash' => 'required|string'
        ]);

        $user = User::where('Email', $request->Email)->first();

        if (!$user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Please verify your email address.'], 403);
        }

        return response()->json([
            'user' => $user->only(['UserID', 'FirstName', 'LastName', 'Email']),
            'token' => $user->createToken('auth_token')->plainTextToken
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }

}
