<?php

namespace App\Http\Services\Admin\PostTag;

use App\Models\PostTag;

class PostTagService
{
    public static function insert($post_id, $tags)
    {
        foreach ($tags as $tag) {
            $post_tag = new PostTag();
            $post_tag->post_id = $post_id;
            $post_tag->tag_id = $tag;
            $post_tag->timestamps = false;
            $post_tag->save();
        }
    }
}
