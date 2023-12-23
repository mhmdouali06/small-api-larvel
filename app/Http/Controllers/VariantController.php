<?php

namespace App\Http\Controllers;

use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        $this->middleware('auth:api,')->except(['index','show']);
    }
    public function index()
    {
        $variants=Variant::with('product')->paginate(10);
       
        return $variants;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $variant=new Variant();
        $variant->name=$request->name;
        $variant->slug=Str::slug($request->name);
        $variant->product_id=$request->product;
        $variant->save();
        return $variant;
    }

    /**
     * Display the specified resource.
     */
    public function show(Variant $variant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Variant $variant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Variant $variant)
    {
        //
    }
}
