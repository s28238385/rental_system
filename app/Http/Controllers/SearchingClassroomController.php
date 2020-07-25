<?php

namespace App\Http\Controllers;

use App\SearchingClassroom;
use App\ReserveShortterm;
use App\ReserveLongterm;
use Illuminate\Http\Request;

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

    //根據calender當前日期及當前教室取得reservation table內相符的資料
    public function ajaxGetReservation(Request $request){

        if ( $request->ajax() ) {
            
            $classroom = $request->input("classroom");
            $date = $request->input("date");
            $currentPeriod = $request->input("period");
            $day = $request->input("day");// 長期借用資料表

            // classroom和reservation字串衝突處理(under line to hyphen)
            $arr_classroom = explode("_", $classroom);
            if ($classroom == "I1_507_1") {
                $classroom = $arr_classroom[0] . "-" . $arr_classroom[1] . "-" . $arr_classroom[2];
            }else {
                $classroom = $arr_classroom[0] . "-" . $arr_classroom[1];
            }

            // currentPeriod由節次轉成時間
            switch ($currentPeriod) {
                case '1':
                    $currentTime = "08";
                    break;
                
                case '2':
                    $currentTime = "09";
                    break;
                
                case '3':
                    $currentTime = "10";
                    break;
                
                case '4':
                    $currentTime = "11";
                    break;
                
                case 'Z':
                    $currentTime = "12";
                    break;
                
                case '5':
                    $currentTime = "13";
                    break;
                
                case '6':
                    $currentTime = "14";
                    break;
                
                case '7':
                    $currentTime = "15";
                    break;
                
                case '8':
                    $currentTime = "16";
                    break;
                
                case '9':
                    $currentTime = "17";
                    break;
                
                case 'A':
                    $currentTime = "18";
                    break;
                
                case 'B':
                    $currentTime = "19";
                    break;
                
                case 'C':
                    $currentTime = "20";
                    break;
                
                case 'D':
                    $currentTime = "21";
                    break;
            }
            // 修正成與資料庫相符的時間
            $currentTime .= ":00:00";// hh:mm::ss

            // 根據request回傳相符資料
            $name = ReserveShortterm::select('*')
                    ->where('classroom', $classroom)
                    ->where('date', $date)// 借用日期相符
                    ->where('startTime', '<=', $currentTime)// 借用時間起迄
                    ->where('endTime', '>=', $currentTime)
                    ->value('name');
            $reason = ReserveShortterm::select('*')
                    ->where('classroom', $classroom)
                    ->where('date', $date)// 借用日期相符
                    ->where('startTime', '<=', $currentTime)// 借用時間起迄
                    ->where('endTime', '>=', $currentTime)
                    ->value('reason');

            // 若短期資料表沒有資料，則從長期表檢查是否存在相符資料
            if ( !($name && $reason) ) {
                // 轉換day
                switch ($day) {
                    case "Sun":
                        $day_long = "日";
                        break;
                    
                    case "Mon":
                        $day_long = "一";
                        break;
                    
                    case "Tue":
                        $day_long = "二";
                        break;
                    
                    case "Wed":
                        $day_long = "三";
                        break;
                    
                    case "Thu":
                        $day_long = "四";
                        break;
                    
                    case "Fri":
                        $day_long = "五";
                        break;
                    
                    case "Sat":
                        $day_long = "六";
                        break;
                }

                $name = ReserveLongterm::select('*')
                    ->where('classroom', $classroom)
                    ->where('startDate', '<=', $date)// 借用日期起訖
                    ->where('endDate', '>=', $date)
                    ->where('DayOfWeek', $day_long)// 當日星期相符
                    ->where('startTime', '<=', $currentTime)// 借用時間起迄
                    ->where('endTime', '>=', $currentTime)
                    ->value('name');
                
                $reason = ReserveLongterm::select('*')
                    ->where('classroom', $classroom)
                    ->where('startDate', '<=', $date)// 借用日期起訖
                    ->where('endDate', '>=', $date)
                    ->where('DayOfWeek', $day_long)// 當日星期相符
                    ->where('startTime', '<=', $currentTime)// 借用時間起迄
                    ->where('endTime', '>=', $currentTime)
                    ->value('reason');
            }
            
            // 檢查是否遍歷完calender，以結束loader
            if ($day == "Sat" && $currentPeriod == 'D') {
                $loadEnd = 1;
            }else {
                $loadEnd = 0;
            }
            
            // 回傳json
            $data = array(
                'name' => $name,
                'reason' => $reason,
                'loadEnd' => $loadEnd
                //'currentTime' => $currentTime //test
                //'classroom' => $classroom //test
            );
            echo json_encode($data);
            
        }
        
    }

}