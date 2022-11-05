<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    public function registerUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);
        try {
            $isUserExist = User::where('email', $request->input('email'))->count();
            if ($isUserExist > 0) {
                return response()->json('Already registered!', 409);
            }
            else {
                $user = new User;
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->password = app('hash')->make($request->input('password'));
                $user->save();
                return response()->json(['user'=>$user, 'message'=>'Account Created!'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Please fill the form correctly'], 409);
        }
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        $user = User::where('email', $request->input('email'))->get();

        if (! $token = Auth::attempt($credentials)) {
            return response()->json('Username or password are incorrect', 401);
        }
        else {
            foreach ($user as $key) {
                $id_user = $key->id;
                $name = $key->name;
                $email = $key->email;
            }
        }

        return $this->respondWithToken($token, $id_user, 22);
    }

    public function logout()
    {
        Auth::logout();
        // return response()->json(['status' => 'logout'], 200);
    }
}