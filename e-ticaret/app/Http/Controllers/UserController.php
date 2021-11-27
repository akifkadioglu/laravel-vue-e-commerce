<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    
    public function editeduser(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_active = $request->active;
        $user->save();
        return User::where('id', $request->id)->first();
    }
    public function edituser(Request $request)
    {
        return User::where('id', $request->id)->first();
    }
    function deleteuser(Request $request)
    {
        User::where('id', $request->id)->first()->delete();
        return User::all();
    }
    public function alluser()
    {
        return User::all();
    }
    public function editactivation($activation)
    {
        $user = User::where('activation_code', $activation)->first();
        $user->is_active = true;
        $user->save();
    }
    public function createuser(Request $request)
    {
        $request->validate([
            'name' => ['required '],
            'email' => ['required ', 'unique:users', ' email'],
            'password' => ['confirmed', 'required', ' min:8']
        ]);

        $user = User::create([
            "password" => Hash::make($request->password),
            "name" => $request->name,
            "email" => $request->email,
            "is_active" => $request->is_active,
            "activation_code" => Str::random(60),
            "password_confirmate" => $request->password_confirmation,
        ]);

        Mail::to($user->email)->send(new RegisterMail($user));

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return Auth::login($user);
        }
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required '],
            'password' => ['required']
        ]);
        $user = User::where('email', $request->email)->first();
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return Auth::login($user);
        }
    }
    public function logout()
    {
        Auth::logout();
    }
    public function updateUser(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (Hash::check($request->password, $user->password)) {

            $user->password = Hash::make($request->newpassword);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            return $user;
        }
    }
}
