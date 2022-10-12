<?php
namespace App\Http\Services\Admin\Permission;

use App\Models\Permission;

class PermissionService{

    public static function getPermissions(){
        return Permission::all();
    }
}
