<?php
namespace App\Http\Services\Admin\Role;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;

class RoleService{

    public function addRole(Request $request): Void
    {
        $role = Role::create(["name" => $request->get("role_name")]);
    }

    public static function getRole(): Collection
    {
        return Role::all();
    }
}
