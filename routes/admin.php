<?php

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('backend.index');
});

Route::group(['namespace'=>'Backend'],function ()
{
    Route::Resource('/users','UsersController');
    Route::Resource('/categories','CategoriesController');
    Route::Resource('/subcategories','SubCategoriesController');

});


