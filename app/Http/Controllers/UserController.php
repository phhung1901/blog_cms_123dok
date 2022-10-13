<?php

namespace App\Http\Controllers;

use App\Http\Services\Admin\Role\RoleService;
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

        $users = $this->userService->getUsers();

        return view("admin.pages.user.user_table", [
            "title" => "User",
            "users" => $users
        ]);
    }

    public function create()
    {
        if (Auth::check()){
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

    public function getRoleUser($id)
    {
        $user = UserService::getUser($id);
        $roles = RoleService::getRoles();

        if ($this->userService->checkRole($id)) {
            return view("admin.pages.user.user_add_role", [
                "title" => "Add user role",
                "roles" => $roles,
                "user" => $user
            ]);
        }
        return view("admin.pages.user.user_add_role", [
            "title" => "Update user role",
            "roles" => $roles,
            "user" => $user,
            "user_role" => $user->getRoleNames()->toArray()
        ]);
    }

    public function setRoleUser(Request $request, $id)
    {
        $roles = $request->get("roles");
        $user = UserService::getUser($id);
        // get old role of this user for remove old role
        $user_role = $user->getRoleNames()->toArray();
        if (count($user_role) != 0){
            foreach ($user_role as $key)
            {
                $user->removeRole($key);
            }
        }
        // add new role
        $user->assignRole($roles);

        return redirect()->route("admin.user.view");
    }

    public function show($id)
    {

    }


    public function edit($id)
    {
        $user = UserService::getUser($id);

        return view("admin.pages.user.user_update", [
            'title' => 'User update',
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        if (UserService::update($request, $id)){
            return redirect()->route("admin.user.view");
        }
        return redirect()->back()->with("error", "Pls, check your form");
    }


    public function destroy($id)
    {
        //
    }
}
