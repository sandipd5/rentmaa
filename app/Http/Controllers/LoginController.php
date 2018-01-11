<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    //

    public function authenticate(User $user)
    {
    	if (Auth::attempt(['email' => $email, 'password' => $password]))

    		{
                       
    		}


    }
}
