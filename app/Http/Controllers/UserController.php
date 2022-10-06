<?php

namespace App\Http\Controllers;

use App\Http\Services\Admin\User\UserService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getUser();


        return view("admin.pages.user.user_table", [
            "title" => "User",
            "users" => $users
        ]);
    }

    public function create()
    {
        if (!Auth::check()){
            return view("admin.auth.register", [
                "title" => "Đăng ký"
            ]);
        }else{
            return redirect()->back();
        }
    }


    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email",
            "password" => "required|min:6|max:100|confirmed",
            "password_confirmation" => "required|same:password"
        ]);

        if (!$validate->fails()){
            $this->userService->addUser($request);
            return redirect()->route("admin.dashboard.view");
        }else{
            $data = $request->all();
            return redirect()->back()->with("error", "Pls, check register")->with(['data' => $data]);
        }
    }

    public function show($id)
    {

    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
