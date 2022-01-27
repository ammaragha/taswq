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




Route::group(['middleware' => ['json.response','api'], 'prefix' => 'v1', 'namespace' => 'Api'], function () {
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });


    /**
     * start Auth routes
     */
    Route::post('register', 'AuthController@register');
   // Route::post('login', 'AuthController@login');



    
   /**
    * start public routes
    */
    Route::get('categories','AppController@categories');
    Route::get('categories/{id}/products','AppController@catProducts');
    Route::get('subcategories/{main}','AppController@subCategories');
    Route::get('subcategories/{id}/products','AppController@subcatProducts');
    Route::get('brands','AppController@brands');
    Route::get('brands/{id}/products','AppController@brandProducts');
    Route::get('products/{id}','AppController@product');

    /**
     * Start Trades 
     */
    Route::group(['middleware'=>'auth:api'],function ()
    {
        Route::post('cart/create','CartController@create');
    });
});
