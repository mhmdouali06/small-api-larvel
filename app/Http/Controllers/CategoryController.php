<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    public function index()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug= Str::slug( $request->name);
        if($request->parent){
            $category->parent_id = $request->parent;
        }
        $category->save();
        return $category;
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
{
    $categoryWithRelations = Category::with('parent', 'children')->find($category->id);

    return $categoryWithRelations;
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
