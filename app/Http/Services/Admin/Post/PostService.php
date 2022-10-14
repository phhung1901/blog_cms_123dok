<?php
namespace App\Http\Services\Admin\Post;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostService{
    public static function validate(Request $request){
        $validate = Validator::make($request->all(), [
            'title' => 'required|min:8|max:100',
        ]);

        return $validate;
    }
}
