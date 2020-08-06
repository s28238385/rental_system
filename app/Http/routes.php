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
Route::get('/', function () {
    return view('homepage');
});

Route::group(['prefix' => 'user'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/signin', [
            'uses' => 'UserController@getSignin',
            'as' => 'user.signin'
        ]);

        Route::post('/signin', [
            'uses' => 'UserController@postSignin',
            'as' => 'user.signin'
        ]);
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/changepw', [
            'uses' => 'UserController@getChangepw',
            'as' => 'user.changepw'
        ]);

        Route::post('/changepw', [
            'uses' => 'UserController@postChangepw',
            'as' => 'user.changepw'
        ]);

        Route::get('/logout', [
            'uses' => 'UserController@getLogout',
            'as' => 'user.logout'
        ]);

        Route::group(['middleware' => 'role'], function(){
            Route::get('/userlist', [
                'uses' => 'UserController@getUserList',
                'as' => 'user.userlist'
            ]);

            Route::get('/signup', [
                'uses' => 'UserController@getSignup',
                'as' => 'user.signup'
            ]);

            Route::post('/signup', [
                'uses' => 'UserController@postSignup',
                'as' => 'user.signup'
            ]);

            Route::get('/resetpassword/{id}', [
                'uses' => 'UserController@getresetPassword',
                'as' => 'user.resetpassword'
            ]);

            Route::post('/resetpassword/{id}', [
                'uses' => 'UserController@postresetPassword',
                'as' => 'user.resetpassword'
            ]);

            Route::get('/deleteacc/{id}', [
                'uses' => 'UserController@getdelAcc',
                'as' => 'user.deleteacc'
            ]);
        });
    });
});

Route::group(['prefix' => 'application'], function() {
    Route::get('/list', [
        'uses' => 'ApplicationController@getList',
        'as' => 'application.list'
    ]);

    Route::get('/information/{application_id}', [
        'uses' => 'ApplicationController@getInformation',
        'as' => 'application.information'
    ]);

    Route::get('/new', [
        'uses' => 'ApplicationController@getNew',
        'as' => 'application.new'
    ]);

    Route::post('/new', [
        'uses' => 'ApplicationController@postNew',
        'as' => 'application.new'
    ]);

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/edit/{application_id}', [
            'uses' => 'ApplicationController@getEdit',
            'as' => 'application.edit'
        ]);

        Route::post('/edit/{application_id}', [
            'uses' => 'ApplicationController@postEdit',
            'as' => 'application.edit'
        ]);

        Route::get('/rent/{application_id}', [
            'uses' => 'ApplicationController@getRent',
            'as' => 'application.rent'
        ]);

        Route::post('/rent/{application_id}', [
            'uses' => 'ApplicationController@postRent',
            'as' => 'application.rent'
        ]);

        Route::get('/return/{application_id}', [
            'uses' => 'ApplicationController@getReturn',
            'as' => 'application.return'
        ]);

        Route::post('/return/{application_id}', [
            'uses' => 'ApplicationController@postReturn',
            'as' => 'application.return'
        ]);

        Route::get('/delete/{application_id}', [
            'uses' => 'ApplicationController@getDelete',
            'as' => 'application.delete'
        ]);
    });
});

Route::get('/master', function () {
    return view('layouts.master');
});


/*Route::get('/', function () {
    return view('layouts.master');
});*/



Route::get('/calender', function () {
    return view('partials.calender');
});

Route::group(['prefix' => 'equipment', 'middleware' => ['auth', 'role']], function () {
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
Route::group(['prefix' => 'classroom'], function () {
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
// 載入預約資料到calender上
Route::get('/statusCalender', [
    'uses' => 'SearchingClassroomController@ajaxGetReservation'
]);

Route::group(['prefix' => 'reservation', 'middleware' => 'auth'], function () {
    Route::get('/list', [
        'uses' => 'ReservationController@getList',
        'as' => 'reservation.list'
    ]);

    Route::get('/new', [
        'uses' => 'ReservationController@getNew',
        'as' => 'reservation.new'
    ]);

    Route::post('/new', [
        'uses' => 'ReservationController@postNew',
        'as' => 'reservation.new'
    ]);

    Route::get('/longterm/{id}', [
        'uses' => 'ReservationController@getLongterm',
        'as' => 'reservation.longterm'
    ]);

    Route::get('/edit/{id}', [
        'uses' => 'ReservationController@getEdit',
        'as' => 'reservation.edit'
    ]);

    Route::post('/edit/{id}', [
        'uses' => 'ReservationController@postEdit',
        'as' => 'reservation.edit'
    ]);

    Route::get('/delete/{id}', [
        'uses' => 'ReservationController@getDelete',
        'as' => 'reservation.delete'
    ]);
});