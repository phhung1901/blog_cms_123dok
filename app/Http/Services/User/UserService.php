<?php
namespace App\Http\Services\User;

use App\Models\Category;
use App\Models\Post;

class UserService
{
    public static function getPosts($slug)
    {
        $category = Category::where("slug", $slug)->select("id")->get()->toArray();
        $posts = Category::find($category[0]["id"])->posts()
            ->join("categories", "posts.category_id", "=", "categories.id")
            ->join("users", "posts.author_id", "=", "users.id")
            ->select("posts.*", "categories.name as category", "users.name as user")
            ->limit(5)
            ->get()->toArray();

        return $posts;
    }

    public static function getPost($slug)
    {
        return Post::where("slug", $slug)->get()->toArray();
    }
}
