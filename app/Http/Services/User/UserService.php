<?php
namespace App\Http\Services\User;

use App\Models\Category;
use App\Models\Post;

//use App\Models\PostTag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

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

    public static function updateView($slug)
    {
        $post = Post::where("slug", $slug)->get();
        $view = $post[0]->view;
        $view++;
        Post::where("slug", $slug)->update(["view" => $view]);
    }

    public static function validateLogin(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        return $validate;
    }

    public static function validateRegister(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email",
            "password" => "required|min:6|max:100|confirmed",
            "password_confirmation" => "required|same:password"
        ]);

        return $validate;
    }

    public static function createUser(Request $request)
    {
        $user = new User();
        $user->name = $request->get("name");
        $user->email = $request->get("email");
        $user->password = bcrypt($request->get("password"));
        $user->save();
    }

    public static function createGoogleUser($user)
    {
        $user = User::updateOrCreate(
            [
                'google_id' => $user->getId()
            ],
            [
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => Hash::make($user->getName() . '@' . $user->getId()),
                'google_id' => $user->getId()
            ]
        );

        return $user;
    }

    public static function checkUser($email)
    {
        return User::where("email", $email)->first();
    }
}
