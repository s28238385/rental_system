<?php

namespace App\Http\Controllers;

use App\SearchingClassroom;
use App\ReserveShortterm;
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

    
    public function ajaxGetReservation(Request $request){

        if ( $request->ajax() ) {
            $classroom = $request->input("classroom");
            
            // $data = DB::table('resrve_shortterm')
            //         ->select('*')
            //         ->where('classroom', $classroom)
            //         ->get();
            $name = ReserveShortterm::select('*')
                    ->where('classroom', $classroom)// ->where('id', 1)
                    ->value('name');
            $reason = ReserveShortterm::select('*')
                    ->where('classroom', $classroom)// ->where('classroom', $classroom)
                    ->value('reason');

            //echo json_encode($data);
            $data = array(
                'name' => $name,
                'reason' => $reason
            );
            echo json_encode($data);;
        }
        
    }

}
