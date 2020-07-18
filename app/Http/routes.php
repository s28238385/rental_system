<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/master', function () {
    return view('layouts.master');
});

Route::get('/calender', function(){
    return view('partials.calender');
});

Route::group(['prefix' => 'equipment'], function () {
    Route::get('/list', [
        'uses' => "EquipmentController@getList",
        'as' => 'equipment.list'
    ]);

    Route::get('/add', [
        'uses' => 'EquipmentController@getAdd',
        'as' => 'equipment.add'
    ]);

    Route::post('/add', [
        'uses' => 'EquipmentController@postAdd',
        'as' => 'equipment.add'
    ]);

    Route::get('/edit/{id}', [
        'uses' => 'EquipmentController@getEdit',
        'as' => 'equipment.edit'
    ]);

    Route::post('/edit/{id}', [
        'uses' => 'EquipmentController@postEdit',
        'as' => 'equipment.edit'
    ]);

    Route::get('delete/{id}', [
        'uses' => 'EquipmentController@getDelete',
        'as' => 'equipment.delete'
    ]);
});

//searchingClassroom
Route::group(['prefix' => 'searching'], function(){
    Route::get('/', [
        'uses' => 'SearchingClassroomController@getList',
        'as' => 'classroom.getList'
    ]);
    
    //經searching選擇教室後的status導向
    Route::post('/status', [
        'uses' => 'SearchingClassroomController@postStatus',
        'as' => 'classroom.status'
    ]);

    //直接訪問status網址處理 
    Route::get('/status', [
        'uses' => 'SearchingClassroomController@getStatus',
        'as' => 'classroom.getStatus'
    ]);
});

Route::get('newapply', 'ApplyController@create');

// store apply
Route::post('newapply', 'ApplyController@store');

//reserve
Route::get('/reservation/classroom_short', function () {
    return view('reservation/classroom_short');
});

Route::get('/reservation/classroom_long', function () {
    return view('reservation/classroom_long');
});

Route::get('/reservation/view_short', function () {
    return view('reservation/view_short');
});

Route::get('/reservation/view_long', function () {
    return view('reservation/view_long');
});

Route::resource('post', 'PostController');
Route::auth();

Route::get('/home', 'HomeController@index');
Route::get("/reservation/classroom_short", "PostController@store_short");
Route::post("/reservation/classroom_short", "PostController@store_short");

Route::get("/reservation/classroom_long", "PostController@store_long");
Route::post("/reservation/classroom_long", "PostController@store_long");