<?php
namespace App\Http\Services\Admin\Post;

use App\Enums\PostStatus;
use App\Http\Services\Admin\Category\CategoryService;
use App\Http\Services\Admin\PostTag\PostTagService;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use BenSampo\Enum\Enum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\at;

class PostService
{
    public static function validate(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required|min:8|max:100',
            'slug' => 'required',
            'description' => 'required|min:15|max:250'
        ]);

        return $validate;
    }

    public static function factoryFile(Request $request)
    {
        $file = $request->file("file");
        $path = Storage::disk('local')->put("public/images", $file);

        return $path;
    }

    public static function createPost(Request $request, $path)
    {
        $title = $request->get("title");
        $slug = $request->get("slug");
        $description = $request->get("description");
        $content = $request->get("content");
        $category_id = $request->get("category");
        $tag_id = $request->get("tag");
        $status = $request->get("status");
        $status = PostStatus::getValue($status);


        $post = new Post();
        $post->title = $title;
        $post->slug = $slug;
        $post->description = $description;
        $post->content = $content;
        $post->thumbnail = $path;
        $post->author_id = Auth::user()->id;
        $post->category_id = $category_id;
        $post->status = $status;
        $post->save();
        PostTagService::insert($post->id, $tag_id);
    }

    public static function createCrawPost(array $attributes)
    {

        $category = Category::firstOrCreate(
            ["name" => $attributes["category"]],
            [
                "name" => $attributes["category"],
                "slug" => \Str::slug($attributes["category"])
            ]
        );

        $category_id = $category->id;

        $tag_id = [];
        foreach ($attributes["tags"] as $item) {
            $tag = Tag::firstOrCreate(
                ["name" => $item["text"]],
                [
                    "name" => $item["text"],
                    "slug" => \Str::slug($item["text"])
                ]
            );
            array_push($tag_id, $tag->id);
        }


        $post = Post::firstOrCreate(
            ["title" => $attributes["title"]],
            [
                "title" => $attributes["title"],
                "slug" => \Str::slug($attributes["title"]),
                "description" => $attributes["description"],
                "content" => $attributes["contents"],
                "thumbnail" => $attributes["thumb"],
                "category_id" => $category_id,
            ]
        );
        $post_id = $post->id;


        foreach ($tag_id as $item) {
            $post_tag = PostTag::updateOrCreate(
                [
                    "post_id" => $post_id,
                    "tag_id" => $item
                ],
                [
                    "post_id" => $post_id,
                    "tag_id" => $item,
                ]
            );
        }

    }

    public static function getPosts()
    {
        return Post::all();
    }

    public static function getPostTags($post_id)
    {
        return Post::find($post_id)->tags;
    }

    public static function getPost($id)
    {
        return Post::find($id);
    }

    public static function getUpdate($id)
    {
        return Post::where("posts.id", $id)
            ->join("categories", "posts.category_id", "=", "categories.id")
            ->select("posts.*", "categories.name as category")
            ->get()->toArray();
    }

    public static function update(Request $request, $id)
    {
        $title = $request->get("title");
        $slug = $request->get("slug");
        $description = $request->get("description");
        $content = $request->get("content");
        $category_id = $request->get("category");
        $tag_id = $request->get("tag");
        $status = $request->get("status");
        $status = PostStatus::getValue($status);
        $file = $request->hasFile("file");

        $post = Post::updateOrCreate(
            ["id" => $id],
            [
                "title" => $title,
                "slug" => $slug,
                "description" => $description,
                "content" => $content,
                "category_id" => $category_id,
                "status" => $status
            ]
        );

        if ($file) {
            $old_path = $post->thumbnail;
            Storage::delete($old_path);
            $path = PostService::factoryFile($request);
            $post->thumbnail = $path;
            $post->save();
        }

        $tag = PostTagService::update($id, $tag_id);

        return true;
    }


    public static function sortPost($col)
    {
        return Post::orderBy($col, "ASC")->get();
    }

}
