<?php

use Illuminate\Http\Request;

Route::get('/categories','API\CategoryController@index');
Route::post('/category/create','API\CategoryController@create');
Route::post('/category/edit','API\CategoryController@edit');
Route::post('/category/delete','API\CategoryController@delete');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
