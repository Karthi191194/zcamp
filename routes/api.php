<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//eapi
//Route::Resource('/products' ,'ProductController'); - if we add this it will also show edit, create. Since this is api we dont need this so use below one
Route::apiResource('/products', 'ProductController');

//eg URL: product/11/reviews - we need URL like like, so we use group of route
Route::group(['prefix' => 'products'], function(){
    Route::apiResource('/{product}/reviews', 'ReviewController');
});
