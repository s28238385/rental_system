<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [
    'uses' => 'UserController@getSignin',
    'as' => 'user.signin',

]);

Route::group(['prefix' => 'user'], function () {
    Route::group(['middleware' => 'guest'], function () {

        Route::get('/signin', [
            'uses' => 'UserController@getSignin',
            'as' => 'user.signin',

        ]);

        Route::post('/signin', [
            'uses' => 'UserController@postSignin',
            'as' => 'user.signin',

        ]);
    });
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/profile', [
            'uses' => 'UserController@getProfile',
            'as' => 'user.profile',

        ]);
        Route::get('/logout', [
            'uses' => 'UserController@getLogout',
            'as' => 'user.logout',

        ]);
        Route::post('/changepw', [
            'uses' => 'UserController@postChangepw',
            'as' => 'user.changepw',

        ]);
        Route::get('/changepw', [
            'uses' => 'UserController@getChangepw',
            'as' => 'user.changepw',

        ]);
        Route::get('/resetphone', [
            'uses' => 'UserController@getresetphone',
            'as' => 'user.resetphone',

        ]);
        Route::post('/resetphone', [
            'uses' => 'UserController@postresetphone',
            'as' => 'user.resetphone',

        ]);
        Route::get('/userlist', [
            'uses' => 'UserController@getUserList',
            'as' => 'user.userlist',

        ]);
        Route::get('/deleteacc/{id}', [
            'uses' => 'UserController@getdelAcc',
            'as' => 'user.deleteacc',
        ]);
        Route::get('/resetpassword/{id}', [
            'uses' => 'UserController@getresetPassword',
            'as' => 'user.resetpassword',
        ]);
        Route::post('/resetpassword/{id}', [
            'uses' => 'UserController@postresetPassword',
            'as' => 'user.resetpassword',
        ]);
        Route::get('/signup', [
            'uses' => 'UserController@getSignup',
            'as' => 'user.signup',

        ]);
        Route::post('/signup', [
            'uses' => 'UserController@postSignup',
            'as' => 'user.signup',

        ]);
    });
});
Route::get('/master', function () {
    return view('layouts.master');
});


/*Route::get('/', function () {
    return view('layouts.master');
});*/

Route::get('/', function () {
    return view('homepage');
});

Route::get('/calender', function () {
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
Route::group(['prefix' => 'searching'], function () {
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
Route::get('/statusCalender', [
    'uses' => 'SearchingClassroomController@ajaxGetReservation'
]);

Route::get('newapply', [
    'uses' => 'ApplyController@create',
    'as' => 'newapply.create'
]);

// store apply
Route::post('newapply', [
    'uses' => 'ApplyController@store',
    'as' => 'newapply.store'
]);

Route::resource('post', 'PostController');
Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'reservation'], function () {
    Route::get('/classroom_short', [
        'uses' => 'ReserveController@getShort',
        'as' => 'reserve.short'
    ]);

    Route::post('/classroom_short', [
        'uses' => 'ReserveController@postShort',
        'as' => 'reserve.short'
    ]);

    Route::get('/classroom_long', [
        'uses' => 'ReserveController@getLong',
        'as' => 'reserve.long'
    ]);

    Route::post('/classroom_long', [
        'uses' => 'ReserveController@postLong',
        'as' => 'reserve.long'
    ]);
});
