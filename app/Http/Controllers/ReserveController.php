<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//use App\Post;


class PostController extends Controller
{
    //
    public function getShort()
    {
        return view("reservation/classroom_short");
    }

    public function postShort(Request $request)
    {
        $today = date("Y-m-d h:i:s");

        $reserveShort = new shortTerm([
            '教室' => $request->input('Classroom'),
            '姓名' => $request->input('Name'),
            '內容' => $request->input('Reason'),
            '日期' => $request->input('Date'),
            '開始節次' => $request->input('Start'),
            '結束節次' => $request->input('End'),
            '登記時間' => $today
        ]);

        $reserveShort -> save();
        return redirect()->route('reserve.short');
    }

    public function getLong()
    {
        return view("reservation/classroom_long");
    }

    public function postLong(Request $request)
    {
        $today = date("Y-m-d h:i:s");

        $reserveShort = new longTerm([
            '教室' => $request->input('Classroom'),
            '姓名' => $request->input('Name'),
            '內容' => $request->input('Reason'),
            '開始日期' => $request->input('DateStart'),
            '結束日期' => $request->input('DateEnd'),
            '星期' => $request->input('DOW'),
            '開始節次' => $request->input('Start'),
            '結束節次' => $request->input('End'),
            '登記時間' => $today
        ]);

        $reserveLong -> save();
        return redirect()->route('reserve.long');
    }
    


}