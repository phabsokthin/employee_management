<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(){
        return view('register');
    }

    public function register_post(Request $request){

        $regis = new User();
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',

        ]);

        $regis->name = $request->name;
        $regis->email = $request->email;
        $regis->password = $request->password;
        $regis->save();
        return redirect()->back()->with("success", "Register Success...");
    }

    //login

    public function login_index(){
        return view('login');
    }

    public function login(Request $request){

        $request->validate([
            'email' => 'required',
            'password' =>  'required',
        ]);
        $select = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($select)){
            return redirect()->route('index');
        }

        return redirect()->back()->with("error", "Incorect email or password");
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login_index');
    }
}
