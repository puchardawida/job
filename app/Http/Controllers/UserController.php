<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function signIn(){
        Auth::loginUsingId(1, true);
        return redirect('/');
    }

    public function logOut(){
        
    }
}
