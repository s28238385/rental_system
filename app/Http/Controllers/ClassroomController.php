<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Reservation;
use Illuminate\Http\Request;

use App\Http\Requests;

class ClassroomController extends Controller
{
    public function getStatus(){
        $classrooms = Classroom::all();

        return view('classroom.status', ['classrooms' => $classrooms]);
    }

    //根據calender當前日期及當前教室取得reservation table內相符的資料
    public function ajaxGetReservation(Request $request){
        if($request->input('classroom') === '#All'){
            $reservations = Reservation::all()
                                        ->where('date', Date("Y-m-d", strtotime($request->input("date"))))
                                        ->toArray();
        }
        else {
            $reservations = Reservation::all()
                                        ->where('date', Date("Y-m-d", strtotime($request->input("date"))))
                                        ->where('classroom', $request->input('classroom'))
                                        ->toArray();
        }

        if ( $request->ajax() ) {
            return response()->json(['data' => $reservations]);
        }
    }
}