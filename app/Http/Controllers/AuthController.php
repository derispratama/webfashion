<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(){
        return view('login.login');
    }

    public function register(){
        return view('login.register');
    }

    public function forgotpass(){
        return view('login.forgotpass');
    }
}
