<?php
namespace App\Http\Services\User;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;

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
        return Post::where("posts.slug", $slug)
            ->join("categories", "posts.category_id", "=", "categories.id")
            ->join("users", "posts.author_id", "=", "users.id")
            ->select("posts.*", "categories.name as category", "categories.slug as category_slug", "users.name as user")
            ->get()->toArray();
    }

    public static function getPostTags($id)
    {
        return Post::find($id)->tags->toArray();
    }
}
