<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PostStatus;
use App\Http\Controllers\Controller;
use App\Http\Services\Admin\Category\CategoryService;
use App\Http\Services\Admin\Post\PostService;
use App\Http\Services\Admin\Tag\TagService;
use App\Http\Services\User\UserService;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        }else {
            PostService::createPost($request, $path);
            return redirect()->route("admin.post.view");
        }
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $post = PostService::getUpdate($id);
        if (count($post) != 0) {
            $post = $post[0];
            $categories = CategoryService::getCategorys()->toArray();
            $post_tag = UserService::getPostTags($id);
            $tags = TagService::getTag();
            $status = PostStatus::getKeys();


            return view("admin.pages.post.post_update", [
                "title" => "Update",
                "post" => $post,
                "categories" => $categories,
                "post_tag" => $post_tag,
                "tags" => $tags,
                "status" => $status
            ]);
        } else {
            return redirect()->route("admin.post.view");
        }
    }

    public function update(Request $request, $id)
    {
        if (PostService::update($request, $id)) {
            return redirect()->route("admin.post.view");
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $post = PostService::getPost($id);
        if ($post != null) {
            $post = $post->toArray();
            Storage::delete($post['thumbnail']);
            Post::destroy($post["id"]);
            return redirect()->route("admin.post.view");
        } else {
            return redirect()->back();
        }
    }

    public function order($col)
    {
        $posts = PostService::sortPost($col);

        return view("admin.pages.post.post_table", [
            "title" => "Post",
            "posts" => $posts
        ]);
    }
}
