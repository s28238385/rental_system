<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//資料庫model
use App\Classroom;
use App\Reservation;

class ClassroomController extends Controller
{
    //顯示所有教室及狀態頁面
    public function getStatus(){
        //取得classrooms table裡所有資料
        $classrooms = Classroom::all();

        //回傳classroom.status，並附帶$classrooms
        return view('classroom.status', ['classrooms' => $classrooms]);
    }

    //根據calender當前日期及當前教室取得reservation table內相符的資料
    public function ajaxGetReservation(Request $request){
        //是取得ajax資料的request才執行
        if ( $request->ajax() ) {
            //如果classroom是#All代表位於總覽頁面，回傳所有教室資料，其餘則只回傳該教室資料
            if($request->input('classroom') === 'All'){
                //取得所有教室該日的借用情況
                $reservations = Reservation::where('date', '>=', Date("Y-m-d", strtotime($request->input("date"))))
                                            ->where('date', '<=', Date("Y-m-d", strtotime($request->input("date") . ' +6 days')))
                                            ->get();
            }
            else {
                //取得特定教室該日的借用情況
                $reservations = Reservation::where('classroom', $request->input('classroom'))
                                            ->where('date', '>=', Date("Y-m-d", strtotime($request->input("date"))))
                                            ->where('date', '<=', Date("Y-m-d", strtotime($request->input("date") . ' +6 days')))
                                            ->get();
            }

            //轉成json格式後回傳
            return response()->json(['data' => $reservations]);
        }
        else {
            return redirect('/');
        }
    }
}