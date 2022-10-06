<?php
namespace App\Http\Services\Admin\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
//use Illuminate\Support\Facades\Validator;
//use Spatie\Permission\Models\Permission;
//use Spatie\Permission\Models\Role;

class UserService{

    public function getUser(): Collection
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

}
