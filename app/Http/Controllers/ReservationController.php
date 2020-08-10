<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//資料庫model
use App\Reservation;

class ReservationController extends Controller
{
    //節次編號
    private $course = ['1', '2', '3', '4', 'Z', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D'];
    //各節次開始時間
    private $begin_time = ['8:00', '9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00'];
    //各節次結束時間
    private $end_time = ['9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00'];

    //取得預約清單
    public function getList(){
        //取出所有該日後的預約資料，並以日期、開始時間、結束時間依序排列，最後以20筆分一列
        $reservations = Reservation::where('date', '>=', Date("Y-m-d", strtotime('now')))
                                    ->orderBy('date', 'ASC')
                                    ->orderBy('begin_time', 'ASC')
                                    ->orderBy('end_time', 'ASC')
                                    ->paginate(20);

        //把資料庫存的key值轉換成時間
        foreach($reservations as $reservation){
            $reservation->begin_time = $this->begin_time[$reservation->begin_time];
            $reservation->end_time = $this->end_time[$reservation->end_time];
        }

        //回傳reservation.list，並附帶$reservations
        return view('reservation.list', ['reservations' => $reservations]);
    }

    //取得新增預約頁面
    public function getNew(){
        //回傳reservation.new
        return view('reservation.new');
    }

    //儲存新增的預約資料
    public function postNew(Request $request){
        //根據預約類型進行不同的輸入值驗證
        if($request->input('reaervation_type') === 'short_term'){
            $this->validate($request, [
                'name' => 'required|string',
                'reason' => 'required|string',
                'classroom' => 'required|string',
                'begin_date' => 'required|date',
                'begin_time' => 'required|string',
                'end_time' => 'required|string'
            ]);
        }
        elseif($request->input('reaervation_type') === 'long_term'){
            $this->validate($request, [
                'name' => 'required|string',
                'reason' => 'required|string',
                'classroom' => 'required|string',
                'begin_date' => 'required|date',
                'end_date' => 'required|date',
                'loop_day' => 'required|array',
                'loop_day.*' => 'required|string',
                'begin_time' => 'required|string',
                'end_time' => 'required|string'
            ]);
        }

        //檢查借用時間是否合理
        if($request->input('reservation_type') === 'long_term'){
            if(strtotime($request->input('begin_date')) > strtotime($request->input('end_date'))){
                return redirect()->back()->withErrors('開始日期必須比結束時間早')->withInput();
            }

            if(is_null($request->input('loop_day'))){
                return redirect()->back()->withErrors('長期預約請勾選重複時間')->withInput();
            }
        }
        if(array_search($request->input('begin_time'), $this->course) > array_search($request->input('end_time'), $this->course)){
            return redirect()->back()->withErrors('開始時間必須比結束時間早')->withInput();
        }
        

        //依不同預約類型進行不同存入方式
        if($request->input('reservation_type') === 'short_term'){
            //檢查是否重疊到其他預約時間
            $duplicate = Reservation::all()
                                    ->where('date', $request->input('begin_date'))
                                    ->where('classroom', $request->input('classroom'))
                                    ->filter(function($value, $key) use ($request){
                                        return $value->end_time >= array_search($request->input('begin_time'), $this->course) && $value->begin_time <= array_search($request->input('end_time'), $this->course);
                                    })
                                    ->toArray();

            //若有重疊則回傳錯誤訊息並導回前一頁面
            if(!empty($duplicate)) {
                return redirect()->back()->withErrors('選中的時間內已有預約')->withInput();
            }

            //建立model以存入資料庫
            $reservation = new Reservation([
                'name' => $request->input('name'),
                'reason' => $request->input('reason'),
                'classroom' => $request->input('classroom'),
                'date' => $request->input('begin_date'),
                'begin_time' => array_search($request->input('begin_time'), $this->course),
                'end_time' => array_search($request->input('end_time'), $this->course)
            ]);
            $executed = $reservation->save();

            //若未成功存入則回傳失敗訊息，並重導至reservation.list
            if(!$executed){
                return redirect()->route('reservation.list')->with('fail', '新增教室預約失敗，請再次嘗試！');
            }
        }
        elseif($request->input('reservation_type') === 'long_term'){
            //依星期進行程式
            for($i = 0; $i < count($request->input('loop_day')); $i++){
                //建立最早的預約日期
                $date = strtotime($request->input('loop_day')[$i], strtotime($request->input('begin_date')));

                while($date <= strtotime($request->input('end_date'))){
                    //檢查是否重疊到其他預約時間
                    $duplicate = Reservation::all()
                                            ->where('date', Date("Y-m-d", $date))
                                            ->where('classroom', $request->input('classroom'))
                                            ->filter(function($value, $key) use ($request){
                                                return $value->end_time >= array_search($request->input('begin_time'), $this->course) && $value->begin_time <= array_search($request->input('end_time'), $this->course);
                                            })
                                            ->pluck('date')
                                            ->toArray();

                    //若有重疊則回傳錯誤訊息並導回前一頁面
                    if(!empty($duplicate)) {
                        return redirect()->back()->withErrors($duplicate[0] . ' 的時段內已有預約！')->withInput();
                    }

                    //下一周
                    $date = strtotime("next " . $request->input('loop_day')[$i], $date);
                }
            }

            //長期預約以第一筆預約的id作為識別，建立一個flag方便程式進行
            $first_record = true;

            //依星期進行程式
            for($i = 0; $i < count($request->input('loop_day')); $i++){
                //建立最早的預約日期
                $date = strtotime($request->input('loop_day')[$i], strtotime($request->input('begin_date')));

                while($date <= strtotime($request->input('end_date'))){
                    if($first_record === true){
                        //建立model以存入資料庫
                        $reservation = new Reservation([
                            'name' => $request->input('name'),
                            'reason' => $request->input('reason'),
                            'classroom' => $request->input('classroom'),
                            'date' => Date("Y-m-d", $date),
                            'begin_time' => array_search($request->input('begin_time'), $this->course),
                            'end_time' => array_search($request->input('end_time'), $this->course)
                        ]);
                        $executed = $reservation->save();

                        //若未成功存入則回傳失敗訊息，並重導至reservation.list
                        if(!$executed){
                            return redirect()->route('reservation.list')->with('fail', '新增教室預約失敗，請再次嘗試！');
                        }

                        //將第一筆預約的id作為長期預約的識別碼
                        $long_term_id = $reservation->id;

                        //取出第一筆資料並更新長期預約識別碼
                        $reservation = Reservation::find($long_term_id);
                        $reservation->long_term_id = $long_term_id;
                        $executed = $reservation->save();

                        //若未成功更新則回傳失敗訊息，並重導至reservation.list
                        if(!$executed){
                            $reservation->delete();

                            return redirect()->route('reservation.list')->with('fail', '新增教室預約失敗，請再次嘗試！');
                        }

                        //結束第一筆存入
                        $first_record = false;
                    }
                    else {
                        //建立model以存入資料庫
                        $reservation = new Reservation([
                            'name' => $request->input('name'),
                            'reason' => $request->input('reason'),
                            'classroom' => $request->input('classroom'),
                            'date' => Date("Y-m-d", $date),
                            'begin_time' => array_search($request->input('begin_time'), $this->course),
                            'end_time' => array_search($request->input('end_time'), $this->course),
                            'long_term_id' => $long_term_id
                        ]);
                        $executed = $reservation->save();

                        //若未成功存入則回傳失敗訊息，並重導至reservation.list
                        if(!$executed){
                            //刪除同期資料
                            $reservations = Reservation::where('long_term_id', $long_term_id);
                            $reservations->delete();

                            return redirect()->route('reservation.list')->with('fail', '新增教室預約失敗，請再次嘗試！');
                        }
                    }

                    //下一周
                    $date = strtotime("next " . $request->input('loop_day')[$i], $date);
                }
            }
        }

        //重導至reservation.list，並回傳成功訊息
        return redirect()->route('reservation.list')->with('success', '新增教室預約成功！');
    }

    //取得同筆長期預約的清單
    public function getLongterm($id){
        //以傳入$id取得資料
        $reservation = Reservation::find($id);
        //透過long_term_id取得同期預約資料
        $reservations = Reservation::all()->where('long_term_id', $reservation->long_term_id)->toArray();
        dd($reservations);
        //把資料庫存的key值轉換成時間
        foreach($reservations as $reservation){
            $reservation['begin_time'] = $this->begin_time[$reservation['begin_time']];
            $reservation['end_time'] = $this->end_time[$reservation['end_time']];
        }

        //回傳reservation.longterm，並附帶$reservations
        return view('reservation.longterm', ['reservations' => $reservations]);
    }

    //取得預約的編輯頁面
    public function getEdit($id){
        //以傳入$id取得資料
        $reservation = Reservation::find($id);

        //把資料庫存的key值轉換成節次編號
        $reservation->begin_time = $this->course[$reservation->begin_time];
        $reservation->end_time = $this->course[$reservation->end_time];

        //回傳reservation.edit，並附帶$reservation
        return view('reservation.edit', ['reservation' => $reservation]);
    }

    //更新修改的預約資料
    public function postEdit(Request $request, $id){
        //進行輸入驗證
        $this->validate($request, [
            'name' => 'required|string',
            'reason' => 'required|string',
            'classroom' => 'required|string',
            'begin_date' => 'required|date',
            'begin_time' => 'required|string',
            'end_time' => 'required|string'
        ]);
        if(array_search($request->input('begin_time'), $this->course) > array_search($request->input('end_time'), $this->course)){
            return redirect()->back()->withErrors('開始時間必須比結束時間早')->withInput();
        }
        //檢查是否重疊到其他預約時間
        $duplicate = Reservation::all()
                                    ->where('date', $request->input('begin_date'))
                                    ->where('classroom', $request->input('classroom'))
                                    ->filter(function($value, $key) use ($request){
                                        return $value->end_time >= array_search($request->input('begin_time'), $this->course) && $value->begin_time <= array_search($request->input('end_time'), $this->course);
                                    })
                                    ->toArray();

        //若有重疊則回傳錯誤訊息並導回前一頁面
        if(!empty($duplicate)) {
            return redirect()->back()->withErrors('選中的時間內已有預約');
        }

        //依傳入$id取出資料
        $reservation = Reservation::find($id);

        //更新資料
        $reservation->name = $request->input('name');
        $reservation->reason = $request->input('reason');
        $reservation->classroom = $request->input('classroom');
        $reservation->date = $request->input('begin_date');
        $reservation->begin_time = array_search($request->input('begin_time'), $this->course);
        $reservation->end_time = array_search($request->input('end_time'), $this->course);
        $executed = $reservation->save();

        //重導至reservation.list，若未成功更新則回傳失敗訊息，若成功更新則回傳成功訊息
        if(!$executed){
            return redirect()->route('reservation.list')->with('fail', '修改教室預約失敗，請再次嘗試！');
        }
        else {
            return redirect()->route('reservation.list')->with('success', '修改教室預約成功！');
        }
    }

    //刪除預約
    public function getDelete($id){
        //依傳入$id取出資料
        $reservation = Reservation::find($id);

        $executed = $reservation->delete();

        //重導至reservation.list，若未成功更新則回傳失敗訊息，若成功更新則回傳成功訊息
        if(!executed){
            return redirect()->route('reservation.list')->with('fail', '刪除預約失敗，請再次嘗試！');
        }
        else {
            return redirect()->route('reservation.list')->with('success', '刪除預約成功！');
        }
    }
}