<?php
namespace App\Http\Services\Admin\Category;

use App\Models\Category;
//use Faker\Extension\ColorExtension;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryService{
    public function getCategory(): Collection
    {
        return Category::orderBy("parent_id", "ASC")->get();
    }

    public function getParentCategory($id): Collection
    {
        return Category::with("allCategories")->find($id);
    }

    public function getChildCategory($id): \Illuminate\Support\Collection
    {
        return DB::table("categories")->select("id")
            ->where("parent_id", $id)->get();
    }

    public function getEdit($id): \Illuminate\Support\Collection
    {
        return DB::table("categories")->select("*")
            ->where("id", $id)->get();
    }

    public function delete($id): Void
    {
        Category::destroy($id);
    }

    public function addCategory(Request $request): Void
    {
        $category = new Category();
        $category->name = $request->get("category_name");
        $category->slug = $request->get("slug");
        $category->description = $request->get("description");
        if ($request->get("parent_id") != "0"){
            $category->parent_id = $request->get("parent_id");
        }

        $category->save();
    }

    public function update(Request $request, $id): Void
    {
        $category = Category::find($id);
        $category->name = $request->get("category_name");
        $category->slug = $request->get("slug");
        $category->description = $request->get("description");
        if ($request->get("parent_id") == 0){
            $category->parent_id = null;
        }else {
            $category->parent_id = $request->get("parent_id");
        }
        $category->save();
    }
}
