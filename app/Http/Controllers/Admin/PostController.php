<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PostStatus;
use App\Http\Controllers\Controller;
use App\Http\Services\Admin\Category\CategoryService;
use App\Http\Services\Admin\Post\PostService;
use App\Http\Services\Admin\Tag\TagService;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = PostService::getPosts();

        return view("admin.pages.post.post_table", [
           "title" => "Post",
           "posts" => $posts
        ]);
    }

    public function create()
    {
        $categories = CategoryService::getCategorys();
        $tags = TagService::getTag();
        $post_status = PostStatus::getKeys();

        return view("admin.pages.post.post_form", [
            'title' => "Create post",
            'categories' => $categories,
            'tags' => $tags,
            'status' => $post_status
        ]);
    }

    public function store(Request $request)
    {
        $validate = PostService::validate($request);

        //check file isset
        if ($request->hasFile("file")){
            $path = PostService::factoryFile($request);
        }


        if ($validate->fails()){
            return redirect()->route("admin.post.create")->with("error", "Pls check your form!");
        }else{
            PostService::createPost($request, $path);
        }
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
