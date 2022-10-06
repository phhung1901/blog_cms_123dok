<?php

namespace App\Http\Controllers;

use App\Http\Services\Admin\Role\RoleService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        $roles = $this->roleService->getRole();
        $user_roles = User::role("super-admin")->get();

        return view("admin.pages.role_table", [
            "title" => "Role",
            "roles" => $roles,
            "user_roles" => $user_roles
        ]);
    }


    public function create()
    {
        return view("admin.pages.role_form", [
            "title" => "Role"
        ]);
    }


    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "role_name" => "required"
        ]);

        if (!$validate->fails()){
            $this->roleService->addRole($request);
        }else{
            return redirect()->back()->with("error", "Pls check form input!");
        }
        return  redirect()->route("admin.role.view");
    }


    public function show($id)
    {
        //
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
