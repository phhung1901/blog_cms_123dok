<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\Tag\TagService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{

    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index()
    {
        $tags = $this->tagService->getTag();

        return view("admin.pages.tag.tag_table", [
            "title" => "Tag",
            "tags" => $tags
        ]);
    }


    public function create()
    {
        return view("admin.pages.tag.tag_form", [
            "title" => "Tag"
        ]);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'tag_name' => 'required',
            'slug' => 'required',
        ]);

        if (!$validate->fails()){
            $this->tagService->add($request);
        }else{
            return redirect()->back()->with("error", "Pls check form input!");
        }

        return redirect()->route("admin.tag.view");
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (count($this->tagService->getEdit($id)) != 0){
            $tag = $this->tagService->getEdit($id);
            $tag = $tag[0];
        }else{
            return redirect()->back();
        }
        return view("admin.pages.tag.tag_update", [
            "title" => "Tag",
            "tag" => $tag
        ]);
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'tag_name' => 'required',
            'slug' => 'required',
        ]);

        if (!$validate->fails()){
            $this->tagService->update($request, $id);
        }else{
            return redirect()->back()->with("error", "Pls check form input!");
        }
        return redirect()->route("admin.tag.view");
    }


    public function destroy($id)
    {
        $tags = $this->tagService->getTag();

        foreach ($tags as $tag){
            if ($tag["id"] == $id){
                $this->tagService->delete($id);
                return redirect()->route("admin.tag.view");
            }
        }
        return redirect()->back();
    }
}
