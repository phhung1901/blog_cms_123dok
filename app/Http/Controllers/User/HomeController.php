<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\Category\CategoryService;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $categories = CategoryService::getCategorys();

        return view("client.pages.home", [
            "title" => "Home",
            "categories" => $categories
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
