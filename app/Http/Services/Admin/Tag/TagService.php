<?php
namespace App\Http\Services\Admin\Tag;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TagService
{
    public static function getTag(): Collection
    {
        return Tag::orderBy("id", "ASC")->get();
    }

    public function add(Request $request): void
    {
        $tag = new Tag();
        $tag->name = $request->get("tag_name");
        $tag->slug = $request->get("slug");
        $tag->save();
    }

    public function delete($id): Void
    {
        Tag::destroy($id);
    }

    public function getEdit($id)
    {
        return DB::table("tags")->select("*")
            ->where("id", $id)->get();
    }

    public function update(Request $request, $id): Void
    {
        $tag = Tag::find($id);
        $tag->name = $request->get("tag_name");
        $tag->slug = $request->get("slug");
        $tag->save();
    }

}
