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
//首頁
Route::get('/', function () {
    return view('homepage');
});

Route::get('/not_allowed_ip', function () {
    return view('not_allowed_ip');
});

//教室預約狀況，前綴uri為classroom
Route::group(['prefix' => 'classroom'], function () {
    Route::get('/status', [
        'uses' => 'ClassroomController@getStatus',
        'as' => 'classroom.status'
    ]);

    //ajax取得預約資訊用網址
    Route::get('/statusCalender', [
        'uses' => 'ClassroomController@ajaxGetReservation',
        'as' => 'status.ajax'
    ]);
});

//教室設備借用相關網址，前綴uri為application
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
        'middleware' => 'ip',
        'uses' => 'ApplicationController@getNew',
        'as' => 'application.new'
    ]);

    Route::post('/new', [
        'uses' => 'ApplicationController@postNew',
        'as' => 'application.new'
    ]);

    //中介層為auth，只有登入時才可以訪問
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/renting_list', [
            'uses' => 'ApplicationController@getRentingList',
            'as' => 'application.renting_list'
        ]);

        Route::get('/returned_list', [
            'uses' => 'ApplicationController@getReturnedList',
            'as' => 'application.returned_list'
        ]);

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

        //只有管理員能使用
        Route::get('/delete/{application_id}', [
            'middleware' => 'role',
            'uses' => 'ApplicationController@getDelete',
            'as' => 'application.delete'
        ]);

        Route::get('rent_key_delete/{application_id}', [
            'uses' => 'ApplicationController@getRentKeyDelete',
            'as' => 'rentkey.delete'
        ]);

        Route::get('rent_equipment_delete/{rent_equipment_id}', [
            'uses' => 'ApplicationController@getRentEquipmentDelete',
            'as' => 'rentequipment.delete'
        ]);
    });

    //無效網址重導回首頁
    Route::get('/information', function () {
        return redirect('/');
    });

    Route::get('/edit', function () {
        return redirect('/');
    });

    Route::get('/rent', function () {
        return redirect('/');
    });

    Route::get('/return', function () {
        return redirect('/');
    });

    Route::get('/delete', function () {
        return redirect('/');
    });

    Route::get('/rent_key_delete', function () {
        return redirect('/');
    });

    Route::get('/rent_equipment_delete', function () {
        return redirect('/');
    });
});

//教室預約相關連結，前綴uri為reservation
Route::group(['prefix' => 'reservation'], function () {
    Route::get('/list', [
        'uses' => 'ReservationController@getList',
        'as' => 'reservation.list'
    ]);

        Route::get('/longterm/{id}', [
            'uses' => 'ReservationController@getLongterm',
            'as' => 'reservation.longterm'
        ]);

    //中介層為auth，只有登入時才可以訪問
    Route::group(['middleware' => ['auth', 'role']], function () {
        Route::get('/new', [
            'uses' => 'ReservationController@getNew',
            'as' => 'reservation.new'
        ]);
    
        Route::post('/new', [
            'uses' => 'ReservationController@postNew',
            'as' => 'reservation.new'
        ]);

        Route::get('/new/{classroom}', [
            'uses' => 'ReservationController@getClassroomNew',
            'as' => 'reservation.classroom.new'
        ]);

        Route::get('/longterm_add/{id}', [
            'uses' => 'ReservationController@getLongtermAdd',
            'as' => 'longterm.add'
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

        Route::get('/longterm_delete/{id}', [
            'uses' => 'ReservationController@getLongtermDelete',
            'as' => 'longterm.delete'
        ]);
    });

    //無效網址重導至首頁
    Route::get('/longterm', function () {
        return redirect('/');
    });

    Route::get('/edit', function () {
        return redirect('/');
    });

    Route::get('/delete', function () {
        return redirect('/');
    });

    Route::get('/longterm_add', function () {
        return redirect('/');
    });

    Route::get('/longterm_delete', function () {
        return redirect('/');
    });
});

//設備相關連結，前綴uri為equipment
Route::group(['prefix' => 'equipment'], function () {
    //中介層為auth及role，只有登入時且身分為系統管理員才可以訪問
    Route::group(['middleware' => 'auth'], function () {
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

        Route::group(['middleware' => 'role'], function () {
            Route::get('/record', [
                'uses' => 'EquipmentController@getRecord',
                'as' => 'equipment.record'
            ]);

            Route::get('delete/{id}', [
                'uses' => 'EquipmentController@getDelete',
                'as' => 'equipment.delete'
            ]);
        });
    });

    //無效網址重導回首頁
    Route::get('/edit', function () {
        return redirect('/');
    });

    Route::get('/delete', function () {
        return redirect('/');
    });
});

//使用者相關，前綴uri為user
Route::group(['prefix' => 'user'], function () {
    //中介層為guest，只有未登入狀況才可以訪問
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

    //中介層為auth，只有登入時才可以訪問
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

        //中介層為role，只有登入時且身分為系統管理員才可以訪問
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

            Route::get('/change_identity/{id}', [
                'uses' => 'UserController@getChangeIdentity',
                'as' => 'user.change.identity'
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

    //無效網址重導回首頁
    Route::get('/resetpassword', function () {
        return redirect('/');
    });

    Route::get('/deleteacc', function () {
        return redirect('/');
    });

    Route::get('/change_identity', function () {
        return redirect('/');
    });
});