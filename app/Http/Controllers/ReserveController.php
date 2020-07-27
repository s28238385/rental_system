<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
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
        if($request->input('Name') == ""){
            return redirect()->route('reserve.short')->with('alert', '申請人不可為空!');
        }
        if($request->input('Date') == ""){
            return redirect()->route('reserve.short')->with('alert', '申請日期不可為空!');
        }

        $this->validate($request, [
            'Classroom' => 'required',
            'Name' => 'required',
            'Date' => 'required|date',
            'Start' => 'required',
            'End' => 'required'
        ]);

        $preDate = $request->input('Date');
        $array_date = explode("/",$preDate);
        $date = $array_date[2]."-".$array_date[0]."-".$array_date[1];

        $GLOBALS['globalStart'] = $request->input('Start');
        $GLOBALS['globalEnd'] = $request->input('End');

        $count = DB::table('reserve_shortterms')
                        ->where('classroom','=',$request->input('Classroom'))            //找同教室
                            ->where('date','=',$date)
                                    ->where(function ($dateSelect){                 //找時間是否有重疊
                                        $dateSelect ->Where(function ($query){
                                                    $query->where('startTime','<=',$GLOBALS['globalStart'])
                                                          ->where('startTime','<=',$GLOBALS['globalEnd'])
                                                          ->where('endTime','>=',$GLOBALS['globalStart'])
                                                          ->where('endTime','>=',$GLOBALS['globalEnd']);
                                                    })->orWhere(function ($dateConditionTwo){
                                                        $dateConditionTwo -> whereBetween('startTime',[$GLOBALS['globalStart'],$GLOBALS['globalEnd']])
                                                                          -> orWhereBetween('endTime',[$GLOBALS['globalStart'],$GLOBALS['globalEnd']]);
                                                    });
                                    })
                                    ->count();

        $reserveShort = new ReserveShortterm([
            'classroom' => $request->input('Classroom'),
            'name' => $request->input('Name'),
            'reason' => $request->input('Reason'),
            'date' => $date,
            'startTime' => $request->input('Start'),
            'endTime' => $request->input('End')
        ]);
        
        if($request->input('Start') < $request->input('End')){
            if($count == 0){
                $reserveShort -> save();
                return redirect()->route('reserve.short')->with('alert', '單次預約新增成功!');
            }
            else{
                return redirect()->route('reserve.short')->with('alert', '所選時段已被預約!');
            }
        }
        else{
            return redirect()->route('reserve.short')->with('alert', '開始節次不可以大於結束節次!');
        }
        
    }

    public function getLong()
    {
        return view("reservation/classroom_long");
    }

    public function postLong(Request $request)
    {
        
        if($request->input('Name') == ""){
            return redirect()->route('reserve.short')->with('alert', '申請人不可為空!');
        }
        if($request->input('DateSart') == "" || $request->input('DateEnd') == ""){
            return redirect()->route('reserve.short')->with('alert', '申請日期不可為空!');
        }

        $this->validate($request, [
            'Classroom' => 'required',
            'Name' => 'required',
            'DateStart' => 'required|date',
            'DateEnd' => 'required|date|after:$request->input(\'DateStart\')',
            'DOW' => 'required',
            'Start' => 'required',
            'End' => 'required'
        ]);
        
        $preDateStart = $request->input('DateStart');
        $array_date_start = explode("/",$preDateStart);
        $GLOBALS['date_start'] = $array_date_start[2]."-".$array_date_start[0]."-".$array_date_start[1];

        $preDateEnd = $request->input('DateEnd');
        $array_date_end = explode("/",$preDateEnd);
        $GLOBALS['date_end'] = $array_date_end[2]."-".$array_date_end[0]."-".$array_date_end[1];
        
        $GLOBALS['globalStart'] = $request->input('Start');
        $GLOBALS['globalEnd'] = $request->input('End');

        
        $count = DB::table('reserve_longterms')
                        ->where('classroom','=',$request->input('Classroom'))            //找同教室
                            ->where('DayOfWeek','=',$request->input('DOW'))              //找同星期
                                ->where(function ($dateSelect){                          //找日期是否有重疊
                                    $dateSelect->whereBetween('startDate',[$GLOBALS['date_start'],$GLOBALS['date_end']])
                                               ->orWhereBetween('endDate',[$GLOBALS['date_start'],$GLOBALS['date_end']])
                                               ->orWhere(function ($query){
                                                $query->where('startDate','<=',$GLOBALS['date_start'])
                                                      ->where('startDate','<=',$GLOBALS['date_end'])
                                                      ->where('endDate','>=',$GLOBALS['date_start'])
                                                      ->where('endDate','>=',$GLOBALS['date_end']);
                                                });
                                })
                                    ->where(function ($dateSelect){                 //找時間是否有重疊
                                        $dateSelect ->Where(function ($query){
                                                    $query->where('startTime','<=',$GLOBALS['globalStart'])
                                                          ->where('startTime','<=',$GLOBALS['globalEnd'])
                                                          ->where('endTime','>=',$GLOBALS['globalStart'])
                                                          ->where('endTime','>=',$GLOBALS['globalEnd']);
                                                    })->orWhere(function ($dateConditionTwo){
                                                        $dateConditionTwo -> whereBetween('startTime',[$GLOBALS['globalStart'],$GLOBALS['globalEnd']])
                                                                          -> orWhereBetween('endTime',[$GLOBALS['globalStart'],$GLOBALS['globalEnd']]);
                                                    });
                                    })
                                    ->count();

        

        $reserveLong = new ReserveLongterm([
            'classroom' => $request->input('Classroom'),
            'name' => $request->input('Name'),
            'reason' => $request->input('Reason'),
            'startDate' => $GLOBALS['date_start'],
            'endDate' => $GLOBALS['date_end'],
            'DayOfWeek' => $request->input('DOW'),
            'startTime' => $request->input('Start'),
            'endTime' => $request->input('End')
        ]);
        

        if($request->input('Start') < $request->input('End')){
            if($count == 0){
                $reserveLong -> save();
                return redirect()->route('reserve.long')->with('alert', '長期預約新增成功!');
            }
            else{
                return redirect()->route('reserve.long')->with('alert', '所選時段已被預約!');
            }
        }
        else{
            return redirect()->route('reserve.long')->with('alert', '開始節次不可以大於結束節次!');
        }
        

        
    }
    
}