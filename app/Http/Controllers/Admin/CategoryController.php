<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\Category\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }


    public function index()
    {
        $categories = CategoryService::getCategorys();

        return view("admin.pages.category.category_table", [
            "title" => "Category",
            "categories" => $categories
        ]);
    }

    public function create()
    {
        $categories = CategoryService::getCategorys();

        return view("admin.pages.category.category_form", [
            "title" => "Category",
            "categories" => $categories
        ]);
    }


    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'category_name' => 'required',
            'slug' => 'required',
            'description' => "required|min:6"
        ]);

        if (!$validate->fails()){
            $this->categoryService->addCategory($request);
        }else{
            return redirect()->back()->with("error", "Pls check form input!");
        }

        return redirect()->route("admin.category.view");
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        if (count($this->categoryService->getEdit($id)) != 0){
            $category = $this->categoryService->getEdit($id);
            $category = $category[0];
            $categories = CategoryService::getCategorys();
        }else{
            return redirect()->back();
        }

        return view("admin.pages.category.category_update", [
            "title" => "Category",
            "category" => $category,
            "categories" => $categories
        ]);
    }


    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'category_name' => 'required',
            'slug' => 'required',
            'description' => "required|min:6"
        ]);

        if (!$validate->fails()){
            $this->categoryService->update($request, $id);
        }else{
            return redirect()->back()->with("error", "Pls check form input!");
        }
        return redirect()->route("admin.category.view");
    }


    public function destroy($id)
    {
        if (count($this->categoryService->getChildCategory($id)) != 0){
            $child = $this->categoryService->getChildCategory($id);

            foreach ($child as $item){
                $this->destroy($item->id);
                $this->categoryService->delete($item->id);
            }
            $this->categoryService->delete($id);

        }else{
            $this->categoryService->delete($id);
        }
        return redirect()->back();
    }
}
