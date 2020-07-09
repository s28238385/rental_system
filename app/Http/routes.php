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

/*Route::get('/calender', function(){
    return view('partials.calender');
});*/

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

Route::get('/searching', [
    'uses' => 'SearchingClassroomController@getList',
    'as' => 'classroom.getList'
]);

Route::get('/reserve_time', function () {
    return view('searching.reserve_time');
});
Route::get('newapply', 'ApplyController@create');

// store apply
Route::post('newapply', 'ApplyController@store');

Route::get('/searching', 'SearchingClassroomController@getList');
