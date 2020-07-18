<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\ReserveShortterm;
use App\ReserveLongterm;


class ReserveController extends Controller
{
    //
    public function getShort()
    {
        return view("reservation/classroom_short");
    }

    public function postShort(Request $request)
    {
        $preDate = $request->input('Date');
        $array_date = explode("/",$preDate);
        $date = $array_date[2]."-".$array_date[0]."-".$array_date[1];

        $reserveShort = new ReserveShortterm([
            'classroom' => $request->input('Classroom'),
            'name' => $request->input('Name'),
            'reason' => $request->input('Reason'),
            'date' => $date,
            'startTime' => $request->input('Start'),
            'endTime' => $request->input('End')
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
        $preDateStart = $request->input('DateStart');
        $array_date_start = explode("/",$preDateStart);
        $date_start = $array_date_start[2]."-".$array_date_start[0]."-".$array_date_start[1];

        $preDateEnd = $request->input('DateEnd');
        $array_date_end = explode("/",$preDateEnd);
        $date_end = $array_date_end[2]."-".$array_date_end[0]."-".$array_date_end[1];

        $reserveLong = new ReserveLongterm([
            'classroom' => $request->input('Classroom'),
            'name' => $request->input('Name'),
            'reason' => $request->input('Reason'),
            'startDate' => $date_start,
            'endDate' => $date_end,
            'DayOfWeek' => $request->input('DOW'),
            'startTime' => $request->input('Start'),
            'endTime' => $request->input('End')
        ]);

        $reserveLong -> save();
        return redirect()->route('reserve.long');
    }
    


}