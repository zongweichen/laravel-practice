<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Hash;

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

    public function SignUpProcess()
    {
        $input = request()->all();

        if ($input["nickname"] == "" ) {
            return redirect("/user/auth/signup")
            ->withErrors("暱稱不得為空")
            ->withInput();
        } elseif ($input["password"] == "") {
            return redirect("/user/auth/signup")
            ->withErrors("密碼不得為空")
            ->withInput();
        } else {
            $input["password"] = Hash::make($input["password"]);
            print_r($input);
        }
        
    }
}