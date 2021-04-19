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
Route::get('category/edit/{slug}','CategoryController@edit');
Route::get('category/categories','CategoryController@index');
Route::post('/category/store','CategoryController@store');
Route::put('/category/update/{slug}','CategoryController@update');
Route::delete('/category/destroy/{slug}','CategoryController@destroy');
Route::get('/category/deleted','CategoryController@deleted')->name('category.deleted');
Route::get('/category/restore/{category}','CategoryController@restored')->name('category.restore');


//tag routes
Route::get('tag/create','TagController@create');
Route::get('tag/edit/{slug}','TagController@edit');
Route::get('tag/tag_list','TagController@index');
Route::post('tag/store','TagController@store');
Route::put('tag/update/{slug}','TagController@update');
Route::delete('tag/destroy/{slug}','TagController@destroy');
Route::get('/tag/deleted','TagController@deleted')->name('tag.deleted');
Route::get('/tag/restore/{slug}','TagController@restored')->name('tag.restore');

//new blog route
Route::get('/newblog/new','BlogController@create')->name('n.blog');
Route::get('/newblog/edit/{slug}','BlogController@edit')->name('e.blog');
Route::post('/newblog/store','BlogController@store');
Route::put('/newblog/update/{slug}','BlogController@update');
Route::delete('/newblog/delete/{slug}','BlogController@destroy')->name('d.blog');
Route::get('/newblog/deleted','BlogController@deleted')->name('deleted.blog');
Route::get('/newblog/restore/{slug}','BlogController@restored')->name('restore.blog');
Route::get('/newblog/deleteimage/{image}','BlogController@delete_image_only')->name('delete.image');

});
Route::get('newblog/blogs','BlogController@index')->name('list.blog');
Route::get('/newblog/show/{slug}','BlogController@show')->name('show.blog');

//Role Routes
Route::get('role/create','AuthorizationController@role_create')->name('c.role');
Route::get('role/edit/{id}','AuthorizationController@role_edit')->name('e.role');
Route::get('role/role_list','AuthorizationController@role_index')->name('i.role');
Route::post('role/store','AuthorizationController@role_store')->name('s.role');
Route::put('role/update/{id}','AuthorizationController@role_update')->name('u.role');
Route::delete('role/destroy/{id}','AuthorizationController@role_destroy')->name('d.role');

//Permission routes
Route::get('permission/create','AuthorizationController@permission_create')->name('c.permission');
Route::get('permission/edit/{id}','AuthorizationController@permission_edit')->name('e.permission');
Route::get('permission/permission_list','AuthorizationController@permission_index')->name('i.permission');
Route::post('permission/store','AuthorizationController@permission_store')->name('s.permission');
Route::put('permission/update/{id}','AuthorizationController@permission_update')->name('u.permission');
Route::delete('permission/destroy/{id}','AuthorizationController@permission_destroy')->name('d.permission');

//User Role routes
Route::get('user_role/edit/{id}','AuthorizationController@user_role_edit')->name('e.user_role');
Route::get('user_role/user_role_list','AuthorizationController@user_role_index')->name('i.user_role');
Route::put('user_role/update/{id}','AuthorizationController@user_role_update')->name('u.user_role');

//Permission role routes
Route::get('permission_role/edit/{id}','AuthorizationController@permission_role_edit')->name('e.permission_role');
Route::get('permission_role/permission_role_list','AuthorizationController@permission_role_index')->name('i.permission_role');
Route::put('permission_role/update/{id}','AuthorizationController@permission_role_update')->name('u.permission_role');
