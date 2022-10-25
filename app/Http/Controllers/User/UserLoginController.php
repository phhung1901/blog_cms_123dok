<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Services\User\UserService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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

    public function create()
    {
        return view("client.auth.register", [
            "title" => "Register"
        ]);
    }

    public function store(Request $request)
    {
        $validate = UserService::validateRegister($request);

        if (!$validate->fails()) {
            UserService::createUser($request);
            return redirect()->route("user.home");
        } else {
            $data = $request->all();
            return redirect()->back()->with("error", "Pls, check register")->with(['data' => $data]);
        }
    }

    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver("google")->user();
        $check = UserService::checkUser($user->getEmail());

        if ($check != null) {
            Auth::loginUsingId($check->id);
            return redirect()->route("user.home");
        } else {
            $user = UserService::createGoogleUser($user);
            Auth::loginUsingId($user->id);
            return redirect()->route("user.home");
        }
        return redirect()->back();

//        dd($check);
    }
}
