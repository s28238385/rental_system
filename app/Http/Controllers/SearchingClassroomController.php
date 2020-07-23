<?php

namespace App\Http\Controllers;

use App\SearchingClassroom;
use App\ReserveShortterm;
use App\ReserveLongterm;
use Illuminate\Http\Request;
use DB;

use App\Http\Requests;

class SearchingClassroomController extends Controller
{
    public function getList(){
        $classrooms = SearchingClassroom::all();
        return view('searching.index', ['classrooms' => $classrooms]);
    }
    
    //經searching選擇教室後的status導向
    public function postStatus(Request $request){
        $classrooms = SearchingClassroom::all();
        $chosen_status = $request->input("chosen_status");
        return view('searching.status', ['classrooms' => $classrooms])->with('chosen_status', $chosen_status);
    }

    //直接訪問status網址處理
    public function getStatus(){
        return redirect()->route('classroom.getList');
    }

    //根據 calender 當前日期及當前教室取得 reservation table 內
    //相符的資料
    public function ajaxGetReservation(Request $request){

        if ( $request->ajax() ) {
            $classroom = $request->input("classroom");

            //和reservation字串衝突處理
            $arr = explode("_", $classroom);
            if ($classroom == "I1_507_1") {
                $classroom = $arr[0] . "-" . $arr[1] . "-" . $arr[2];
            }else {
                $classroom = $arr[0] . "-" . $arr[1];
            }

            $name = ReserveShortterm::select('*')
                    ->where('classroom', $classroom)
                    ->value('name');
            $reason = ReserveShortterm::select('*')
                    ->where('classroom', $classroom)
                    ->value('reason');

            
            $data = array(
                'name' => $name,
                'reason' => $reason,
                'classroom' => $classroom //test
            );
            echo json_encode($data);;
        }
        
    }

}
