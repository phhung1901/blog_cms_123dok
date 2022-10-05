<?php
namespace App\Http\Services\Admin\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserService{
    public function addUser(Request $request){
        $user = new User();
        $user->name = $request->get("name");
        $user->email = $request->get("email");
        $user->password = bcrypt($request->get("password"));
        $user->role = "1";
        $user->save();
    }
}
