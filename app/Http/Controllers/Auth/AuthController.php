<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  /**
   * Display the specified resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request)
  {
    $user = $request->user();

    return response($user, 201);
  }

  /*
   * Register a new user
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function register(Request $request)
  {
    $rules = [
      "name" => "required|string",
      "email" => "required|string|email|unique:users,email",
      "password" => "required|string|confirmed"
    ];

    $fields = $request->validate($rules);

    $user = User::create([
      "name" => $fields['name'],
      "email" => $fields['email'],
      "password" => Hash::make($fields['password'])
    ]);

    $token = $user->createToken('authtoken')->plainTextToken;

    $response = [
      "user" => $user,
      "token" => $token
    ];

    return response($response, 201);
  }

  /**
   * Authenticate a new user
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function login(Request $request)
  {
    $rules = [
      "email" => "required|string|email",
      "password" => "required|string"
    ];

    $fields = $request->validate($rules);

    $user = User::where('email', $fields['email'])->first();
    if (!$user || !Hash::check($fields['password'], $user->password)) {
      return response([
        'message' => 'invalid credentials'
      ], 401);
    }

    $token = $user->createToken('authtoken')->plainTextToken;

    $response = [
      "user" => $user,
      "token" => $token
    ];

    return response($response, 200);
  }

  /**
   * Logout user
   *
   * @return \Illuminate\Http\Response
   */
  public function logout(Request $request)
  {
    $request->user()->tokens()->delete();

    $message = [
      "message" => "logged_out"
    ];

    return response($message, 200);
  }
}
