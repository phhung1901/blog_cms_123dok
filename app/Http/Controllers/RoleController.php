<?php

namespace App\Http\Controllers;

use App\Http\Services\Admin\Permission\PermissionService;
use App\Http\Services\Admin\Role\RoleService;
use App\Models\Role;
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
        $roles = RoleService::getRoles();

        return view("admin.pages.role.role_table", [
            "title" => "Role",
            "roles" => $roles
        ]);
    }


    public function create()
    {
        return view("admin.pages.role.role_form", [
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


    public function getPermissionRole($id){
        $role = RoleService::getRole($id);
        $permissions = PermissionService::getPermissions();

        if (RoleService::checkPermission($id)){
            return view("admin.pages.role.role_add_permission", [
                "title" => "Add role permission",
                "role" => $role,
                "permissions" => $permissions
            ]);
        }
        return view("admin.pages.role.role_add_permission", [
            "title" => "Add role permission",
            "role" => $role,
            "permissions" => $permissions,
            "permission_role" => $role->getPermissionNames()->toArray()
        ]);
    }

    public function setPermissionRole(Request $request, $id){
        $role = RoleService::getRole($id);
        $permissions = $request->get("permission");
        $permissions_role = $role->getAllPermissions();
        foreach ($permissions_role as $key){
            $role->revokePermissionTo($key);
        }
        $role->givePermissionTo($permissions);
        return redirect()->route("admin.role.view");
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
        if (RoleService::getRole($id) != null){
            $role = RoleService::getRole($id);
//            dd($role);
            $role->delete();
            return redirect()->route("admin.role.view");
        }else{
            return redirect()->back();
        }
    }
}
