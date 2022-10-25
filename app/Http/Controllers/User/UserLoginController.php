<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Services\User\UserService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function login(Request $request)
    {
        $validate = UserService::validateLogin($request);

        if (!$validate->fails()) {
            if (Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ])) {
                return redirect()->route("user.home");
            } else {
                return redirect()->back()->with('error', 'Pls, login agian!');
            }
        } else {
            return redirect()->route("user.login.view")->with('error', 'Pls, check input login!');
        }
    }

    public function showLoginForm()
    {
        return view('client.auth.login', [
            "title" => "Login"
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("user.login.view");
    }
}
