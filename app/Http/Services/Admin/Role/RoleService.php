<?php
namespace App\Http\Services\Admin\Role;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleService{

    public function addRole(Request $request): Void
    {
        $role = Role::create(["name" => $request->get("role_name")]);
    }

    public static function getRoles(): Collection
    {
        return Role::all();
    }

    public static function getRole($id){
        return Role::find($id);
    }

    public static function checkPermission($id){
        $count = count(DB::table("role_has_permissions")->select("role_id")
            ->where("role_id", $id)->get());

        if ($count == 0){
            return true;
        }else{
            return false;
        }
    }
}
