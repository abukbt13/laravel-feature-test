<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function RegisterUser(RegisterRequest $request)
    {
        // Validate and get the validated data from the request
        $data = $request->validated();

        // Create a new user instance and populate it with the validated data
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);

        // Save the user to the database
        $user->save();

        // Generate a token for the newly created user
        $token = $user->createToken('token')->plainTextToken;

        // Return a JSON response with the status, message, token, and user data
        return response()->json([
            'status' => 'success',
            'message' => 'Registered successfully',
            'token' => $token,
            'user' => $user
        ], 201);
    }


    public function LoginUser(Request $request)
    {
        // Validate the request data
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            // Get the authenticated user
            $user = Auth::user();

            // Generate a token for the user
            $token = $user->createToken('token')->plainTextToken;

            // Return a successful response with the token
            return response()->json([
                'status' => 'success',
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user
            ], 200);
        }

        // Return an error response for invalid credentials
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid credentials'
        ], 401);
    }}
