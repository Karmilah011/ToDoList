<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getLogin() {
        return view('Auth.login');
    }
    public function PostLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password'  => 'required'
        ]);
        $user = User::where('email', $request->input('email'))->first();
        if($user && Hash::check($request->input('password'), $user->password)){
            Auth::login($user);
            return redirect()->route('dashboard')->with('success','You are logged in successfully');
        } else{
            return redirect()->route('login')->with('error','Your email or password is incorrect');
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }

    public function getRegister() {
        return view('Auth.register');
    }

    public function PostRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:6'
        ]);

        $users = new User();
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->password = Hash::make($request->input('password'));
        $users->save();

        return redirect()->route('login')->with('success', 'Successful registration');
    }

}
