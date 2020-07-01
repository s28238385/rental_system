<?php

namespace App\Http\Controllers;

use App\SearchingClassroom;
use Illuminate\Http\Request;

use App\Http\Requests;

class SearchingClassroomController extends Controller
{
    public function getList(){
        $classrooms = SearchingClassroom::all();
        return view('searching.index', ['classrooms' => $classrooms]);
    }
}
