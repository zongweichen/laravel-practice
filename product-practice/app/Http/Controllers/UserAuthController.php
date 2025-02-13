<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class UserAuthController extends Controller
{
    public function Login()
    {
        return(111);
    }

    public function SignUpPage()
    {
        $binding = [
            "title" => "註冊",
            "note" => "使用者註冊頁面",
        ];

        return view("auth.signup", $binding);
    }
}