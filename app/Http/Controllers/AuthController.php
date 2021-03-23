<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }

    public function loginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $loginSuccessful = Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        if($loginSuccessful){
            return redirect()->route('profile.index');
        }
        else{
            return redirect()->route('auth.loginForm')->with('error', 'Invalid Credentials');
        }
    }    

    public function maintenanceToggle(Request $request){
        $toggle = Configuration::where('name','=','maintenance-mode')->first();
        $toggle->value = !$toggle->value;
        $toggle->save();

        return redirect()->route('admin');

    }

    public function adminPage(){
        $toggle = Configuration::where('name','=','maintenance-mode')->first();

        return view('admin', [
            'toggle' => $toggle
        ]);
    }
}
