<?php
namespace App\Http\Services\Admin\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Validator;
//use Spatie\Permission\Models\Permission;
//use Spatie\Permission\Models\Role;

class UserService{

    public function getUsers(): Collection
    {
        return User::all();
    }

    public function addUser(Request $request): Void
    {
        $user = new User();
        $user->name = $request->get("name");
        $user->email = $request->get("email");
        $user->password = bcrypt($request->get("password"));
        $user->role = "1";
        $user->save();
    }

    public static function getUser($id)
    {
        return User::find($id);
    }

    public function checkRole($id){
        $count = count(DB::table("model_has_roles")->select("model_id")
            ->where("model_id", $id)->get());

        if ($count == 0){
            return true;
        }else{
            return false;
        }
    }

    public static function getUserPermissions($id){
        $user = self::getUser($id);
        $permissions_data = $user->getAllPermissions()->toArray();
        $permissions = "";
        foreach ($permissions_data as $permission){
            $permissions .= $permission["name"]. ", ";
        }
        return $permissions;
    }

}
