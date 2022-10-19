<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\Category\CategoryService;
use App\Http\Services\User\UserService;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index($slug)
    {
        $categories = CategoryService::getCategorys();
        $posts = UserService::getPosts($slug);

//        dd($posts);

        return view("client.pages.list", [
            "title" => "List",
            "categories" => $categories,
            "posts" => $posts
        ]);
    }

    public function societyPost(){
        return view("client.pages.xahoi", [
            "title" => "Xã hội"
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($slug)
    {
        $post = UserService::getPost($slug);
        $post = $post[0];
        $posts = array_slice(UserService::getPosts($post["category_slug"]), 0, 2);
        $tags = UserService::getPostTags($post["id"]);

        return view("client.pages.detail", [
            "title" => "Detail",
            "post" => $post,
            "tags" => $tags,
            "posts" => $posts
        ]);
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
