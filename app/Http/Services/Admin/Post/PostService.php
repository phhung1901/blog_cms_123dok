<?php
namespace App\Http\Services\Admin\Post;

use App\Enums\PostStatus;
use App\Http\Services\Admin\PostTag\PostTagService;
use App\Models\Post;
use App\Models\PostTag;
use BenSampo\Enum\Enum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostService
{
    public static function validate(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required|min:8|max:100',
            'slug' => 'required',
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
        $content = $request->get("content");
        $category_id = $request->get("category");
        $tag_id = $request->get("tag");
        $status = $request->get("status");
        $status = PostStatus::getValue($status);


        $post = new Post();
        $post->title = $title;
        $post->slug = $slug;
        $post->content = $content;
        $post->thumbnail = $path;
        $post->author_id = Auth::user()->id;
        $post->category_id = $category_id;
        $post->status = $status;
        $post->save();
        PostTagService::insert($post->id, $tag_id);
    }

    public static function getPosts()
    {
        return Post::all();
    }

    public static function getPostTags($post_id)
    {
        return Post::find($post_id)->tags;
    }
}
