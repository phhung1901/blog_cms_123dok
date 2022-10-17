<?php
namespace App\Http\Services\Admin\Post;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostService{
    public static function validate(Request $request){
        $validate = Validator::make($request->all(), [
            'title' => 'required|min:8|max:100',
            'slug' => 'required',
        ]);

        return $validate;
    }

    public static function factoryFile(Request $request){
        $file = $request->file("file");
        $get_file_name = $file->getClientOriginalName();

        Storage::disk('local')->put($get_file_name, $file);
    }
}
