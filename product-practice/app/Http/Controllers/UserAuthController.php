<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Hash;
use App\Shop\Entity\User;
use Illuminate\Support\Facades\Mail;

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
        }elseif (User::where( "email", $input["email"])->count() > 0) {
            return redirect("/user/auth/signup")
            ->withErrors("信箱重複")
            ->withInput();
        }
        else {
            $input["password"] = Hash::make($input["password"]);
            User::create($input);
            Mail::send('email.signUpEmailNotification', ['nickname' => $input['nickname']], function($message) use ($input) {
                $message->to($input['email'], $input['nickname'])->from('jay879944@gmail.com')->subject('恭喜註冊成功');
            });
    
        }
        
    }
}