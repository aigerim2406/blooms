<?php

namespace App\Http\Controllers\Auth2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function create(){
        return view('auth.login');
    }

    public function login(Request $request){
        if (Auth::check()){
            return redirect()->intended('/posts');
        }
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($validated)){
            if(Auth::user()->role == "admin")
                return redirect()->intended('/admin/users');
            return redirect()->intended('/posts')->with('message', 'welcome to we site');

        }
        return back()->withErrors('Incorrect email or password');
    }

    public function logout(){
        Auth::logout();
        return redirect()->intended('/posts')->with('message', 'bye bye');
    }
}
