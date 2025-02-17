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

    public function SignInPage()
    {
        $binding = [
            "title" => "登入",
            "note" => "使用者登入頁面",
        ];

        return view("auth.signin", $binding);
    }

    public function SignInProcess()
    {
        $input = request()->all();
        //登入邏輯
        //取得參數
        $tempuser = User::where("email", $input["email"])->first();
        
        if(is_null($tempuser)){
            return redirect("/user/auth/signin")
            ->withErrors("無此帳號")
            ->withInput();
        } else {
            if(Hash::check($input["password"], $tempuser->password)){ //$tempuser["password"]
                session()->put("user_id", $tempuser->id);
                return redirect("/user/auth/signin")
                ->withErrors("有此帳號")
                ->withInput();
            } else {
                return redirect("/user/auth/signin")
                ->withErrors("密碼錯誤")
                ->withInput();
            }
        }

        
            




    }

    public function SignOut()
    {
        session()->forget("user_id");
        return redirect("/user/auth/signin");
    }
}