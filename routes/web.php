<?php


Route::get('/', function () {
    return view('welcome');
});
Route::get('/myroute','Test@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(['auth'])->group(function(){
//category routes

Route::get('category/create','CategoryController@create');
Route::get('category/edit/{id}','CategoryController@edit');
Route::get('category/categories','CategoryController@index');
Route::post('/category/store','CategoryController@store');
Route::put('/category/update/{id}','CategoryController@update');
Route::delete('/category/destroy/{id}','CategoryController@destroy');
Route::get('/category/deleted','CategoryController@deleted')->name('category.deleted');
Route::get('/category/restore/{category}','CategoryController@restored')->name('category.restore');


//tag routes
Route::get('tag/create','TagController@create');
Route::get('tag/edit/{id}','TagController@edit');
Route::get('tag/tag_list','TagController@index');
Route::post('tag/store','TagController@store');
Route::put('tag/update/{id}','TagController@update');
Route::delete('tag/destroy/{id}','TagController@destroy');
Route::get('/tag/deleted','TagController@deleted')->name('tag.deleted');
Route::get('/tag/restore/{id}','TagController@restored')->name('tag.restore');

//new blog route
Route::get('/newblog/new','BlogController@create')->name('n.blog');
Route::get('/newblog/edit/{id}','BlogController@edit')->name('e.blog');
Route::post('/newblog/store','BlogController@store');
Route::put('/newblog/update/{id}','BlogController@update');
Route::delete('/newblog/delete/{id}','BlogController@destroy')->name('d.blog');
Route::get('/newblog/deleted','BlogController@deleted')->name('deleted.blog');
Route::get('/newblog/restore/{id}','BlogController@restored')->name('restore.blog');

});
Route::get('newblog/blogs','BlogController@index')->name('list.blog');
Route::get('/newblog/show/{id}','BlogController@show')->name('show.blog');

