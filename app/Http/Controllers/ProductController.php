<?php

namespace App\Http\Controllers;

use App\eapi_model\Product;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //eapi
        //API resource/transformer
        return Product::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\eapi_model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //eapi
        //API resource/transformer
        //single product
        //return $product; return default ouptut
        return new ProductResource($product); // return resource output
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\eapi_model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\eapi_model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\eapi_model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    //One To One
    public function oneToOne(){
        //"with" enables you to use method of a model.
        $products = Product::with('rel_reviews')->get();
    }
}
