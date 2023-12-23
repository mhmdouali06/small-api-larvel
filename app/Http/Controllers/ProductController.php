<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware(['auth:api','role:admin|writer']);
    }
    public function index()
    {
        $products=Product::with("variants")->paginate(10);
        // Gate::authorize('view',$products[0]);
        $products=ProductResource::collection($products);
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product=new Product();
        $product->name=$request->name;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->category_id=$request->category;
        if($request->image){
            $product->image=$request->image->store('products', 'public');
        }
        $product->save();
        return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product=new ProductResource($product);
        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
