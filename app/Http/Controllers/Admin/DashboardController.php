<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        $datas = DB::table("categories")
            ->join("posts", "posts.category_id", "=", "categories.id")
            ->select("categories.id", DB::raw('count(*) as total'), "categories.slug")
            ->groupBy("id")
            ->get()->toArray();

        $categories = [];
        $postof = [];

        foreach ($datas as $data) {
            array_push($categories, $data->slug);
            array_push($postof, $data->total);
        }

        $categories = json_encode($categories, JSON_UNESCAPED_UNICODE);
        $postof = json_encode($postof, JSON_UNESCAPED_UNICODE);

        return view("admin.dashboard.chart", [
            "title" => "Dashboard",
            "categories" => $categories,
            "postof" => $postof
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
