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

Route::get('/aaa', function(){
   echo Route('reviews.index', 4);
});

//JWT Method 1
Route::post('jwtregister', 'JWTRegisterController@register');
Route::post('jwtlogin', 'JWTLoginController@login');

Route::middleware('jwt.auth')->get('users', function(Request $request) {
    return auth()->user();
});

//JWT Method 2
//http://localhost/zcamp/public/api/auth/me
Route::group([

    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('payload', 'AuthController@payload');

});