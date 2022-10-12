<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\Permission\PermissionService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function index()
    {
        $permissions = PermissionService::getPermissions();
//        dd($permissions);
        return view("admin.pages.permission.permission_table", [
            "title" => "Permission",
            "permissions" => $permissions
        ]);
    }


    public function create()
    {
        return view("admin.pages.permission.permission_form", [
            "title" => "Add Permission"
        ]);
    }


    public function store(Request $request)
    {
        Permission::create(["name" => $request->get("permission_name")]);
        return redirect()->route("admin.permission.index");
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
