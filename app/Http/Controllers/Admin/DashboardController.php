<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{

    public function index()
    {
//        $role = Role::create(["name" => "admin"]);
//        $role = Role::create(["name" => "user"]);
//        $role = Role::create(["name" => "client"]);
//        $role = Role::create(['name' => "super-admin"]);
//        $permission = Permission::create(['name' => "post manage"]);
//        $permission = Permission::create(['name' => "category manage"]);
//        $permission = Permission::create(['name' => "tag manage"]);
//        $permission1 = Permission::create(['name' => "roles manage"]);
//        $permission2 = Permission::create(['name' => "permissions manage"]);
//        $permission3 = Permission::create(['name' => "user manage"]);
//
//        $user = Auth::user();
//        $user->assignRole("super-admin");
//        $permission1->assignRole("super-admin");
//        $permission2->assignRole("super-admin");
//        $permission3->assignRole("super-admin");


        return view("admin.dashboard.index", [
            "title" => "Dashboard"
        ]);
    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        //
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
