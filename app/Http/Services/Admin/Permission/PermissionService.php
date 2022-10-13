<?php
namespace App\Http\Services\Admin\Permission;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionService{

    public static function getPermissions(){
        return Permission::all();
    }

    public static function getPermission($id){
        return Permission::findOrFail($id);
    }

    public static function checkPermission(Request $request){
        $permission = $request->get("permission_name");
        if (count(Permission::where("name", $permission)->get()) != 0){
            return true;
        }
        return false;
    }
}
