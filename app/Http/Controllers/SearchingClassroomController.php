<?php

namespace App\Http\Controllers;

use App\SearchingClassroom;
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



}
