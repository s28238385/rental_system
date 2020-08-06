<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Reservation;

class ReservationController extends Controller
{
    private $class = ['1', '2', '3', '4', 'Z', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D'];
    private $begin_time = ['8:00', '9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00'];
    private $end_time = ['9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00'];

    public function getList(){
        $reservations = Reservation::all()
                                    ->filter(function($value){
                                            return $value['date'] >= Date("Y-m-d", strtotime('now'));
                                        })
                                    ->sortBy('end_time')->sortBy('begin_time')->sortBy('date');

        foreach($reservations as $reservation){
            $reservation->begin_time = $this->begin_time[$reservation->begin_time];
            $reservation->end_time = $this->end_time[$reservation->end_time];
        }

        return view('reservation.list', ['reservations' => $reservations]);
    }

    public function getNew(){
        return view('reservation.new');
    }

    public function postNew(Request $request){
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
                'begin_date' => 'required|date|before_or_equal:end_date',
                'end_date' => 'required|date|after_or_equal:begin_date',
                'loop_day' => 'required|array',
                'loop_day.*' => 'required|string',
                'begin_time' => 'required|string',
                'end_time' => 'required|string'
            ]);
        }

        if(array_search($request->input('begin_time'), $this->class) > array_search($request->input('end_time'), $this->class)){
            return redirect()->back()->withError('結束時間必須比開始時間晚！')->withInput();
        }

        if($request->input('reservation_type') === 'short_term'){
            $duplicate = Reservation::all()
                                    ->where('date', $request->input('begin_date'))
                                    ->where('classroom', $request->input('classroom'))
                                    ->filter(function($value, $key) use ($request){
                                        return $value->end_time >= array_search($request->input('begin_time'), $this->class) && $value->begin_time <= array_search($request->input('end_time'), $this->class);
                                    })
                                    ->toArray();

            if(!empty($duplicate)) {
                return redirect()->back()->withError('選中的時間內已有預約！')->withInput();
            }
            
            $reservation = new Reservation([
                'name' => $request->input('name'),
                'reason' => $request->input('reason'),
                'classroom' => $request->input('classroom'),
                'date' => $request->input('begin_date'),
                'begin_time' => array_search($request->input('begin_time'), $this->class),
                'end_time' => array_search($request->input('end_time'), $this->class)
            ]);
            $executed = $reservation->save();

            if(!$executed){
                return redirect('/')->with('fail', '新增教室預約失敗！');
            }
        }
        elseif($request->input('reservation_type') === 'long_term'){
            for($i = 0; $i < count($request->input('loop_day')); $i++){
                $date = strtotime($request->input('loop_day')[$i], strtotime($request->input('begin_date')));

                while($date <= strtotime($request->input('end_date'))){
                    $duplicate = Reservation::all()
                                            ->where('date', Date("Y-m-d", $date))
                                            ->where('classroom', $request->input('classroom'))
                                            ->filter(function($value, $key) use ($request){
                                                return $value->end_time >= array_search($request->input('begin_time'), $this->class) && $value->begin_time <= array_search($request->input('end_time'), $this->class);
                                            })
                                            ->pluck('date')
                                            ->toArray();

                    if(!empty($duplicate)) {
                        return redirect()->back()->withError($duplicate[0] . ' 的時段內已有預約！')->withInput();
                    }

                    $date = strtotime("next " . $request->input('loop_day')[$i], $date);
                }
            }

            $first_record = true;

            for($i = 0; $i < count($request->input('loop_day')); $i++){
                $date = strtotime($request->input('loop_day')[$i], strtotime($request->input('begin_date')));

                while($date <= strtotime($request->input('end_date'))){
                    if($first_record === true){
                        $reservation = new Reservation([
                            'name' => $request->input('name'),
                            'reason' => $request->input('reason'),
                            'classroom' => $request->input('classroom'),
                            'date' => Date("Y-m-d", $date),
                            'begin_time' => array_search($request->input('begin_time'), $this->class),
                            'end_time' => array_search($request->input('end_time'), $this->class)
                        ]);
                        $executed = $reservation->save();

                        if(!$executed){
                            return redirect('/')->with('fail', '新增教室預約失敗！');
                        }

                        $long_term_id = $reservation->id;

                        $reservation = Reservation::find($long_term_id);
                        $reservation->long_term_id = $long_term_id;
                        $executed = $reservation->save();

                        if(!$executed){
                            $reservation->delete();

                            return redirect('/')->with('fail', '新增教室預約失敗！');
                        }

                        $first_record = false;
                    }
                    else {
                        $reservation = new Reservation([
                            'name' => $request->input('name'),
                            'reason' => $request->input('reason'),
                            'classroom' => $request->input('classroom'),
                            'date' => Date("Y-m-d", $date),
                            'begin_time' => array_search($request->input('begin_time'), $this->class),
                            'end_time' => array_search($request->input('end_time'), $this->class),
                            'long_term_id' => $long_term_id
                        ]);
                        $executed = $reservation->save();

                        if(!$executed){
                            $reservations = Reservation::where('long_term_id', $long_term_id);
                            $reservations->delete();

                            return redirect('/')->with('fail', '新增教室預約失敗！');
                        }
                    }

                    $date = strtotime("next " . $request->input('loop_day')[$i], $date);
                }
            }
        }

        return redirect('/')->with('success', '新增教室預約成功！');
    }

    public function getLongterm($id){
        $reservation = Reservation::find($id);
        $reservations = Reservation::all()->where('long_term_id', $reservation->long_term_id);

        foreach($reservations as $reservation){
            $reservation->begin_time = $this->begin_time[$reservation->begin_time];
            $reservation->end_time = $this->end_time[$reservation->end_time];
        }

        return view('reservation.longterm', ['reservations' => $reservations]);
    }

    public function getEdit($id){
        $reservation = Reservation::find($id);

        $reservation->begin_time = $this->class[$reservation->begin_time];
        $reservation->end_time = $this->class[$reservation->end_time];

        return view('reservation.edit', ['reservation' => $reservation]);
    }

    public function postEdit(Request $request, $id){
        $duplicate = Reservation::all()
                                    ->where('date', $request->input('begin_date'))
                                    ->where('classroom', $request->input('classroom'))
                                    ->filter(function($value, $key) use ($request){
                                        return $value->end_time >= array_search($request->input('begin_time'), $this->class) && $value->begin_time <= array_search($request->input('end_time'), $this->class);
                                    })
                                    ->toArray();

        if(!empty($duplicate)) {
            return redirect()->back()->withError('選中的時間內已有預約！');
        }

        $reservation = Reservation::find($id);

        $reservation->name = $request->input('name');
        $reservation->reason = $request->input('reason');
        $reservation->classroom = $request->input('classroom');
        $reservation->date = $request->input('begin_date');
        $reservation->begin_time = array_search($request->input('begin_time'), $this->class);
        $reservation->end_time = array_search($request->input('end_time'), $this->class);
        $executed = $reservation->save();

        if(!$executed){
            return redirect()->route('reservation.list')->with('fail', '修改教室預約失敗！');
        }
        else {
            return redirect()->route('reservation.list')->with('success', '修改教室預約成功！');
        }
    }

    public function getDelete($id){
        $reservation = Reservation::find($id);

        $executed = $reservation->delete();

        if(!executed){
            return redirect()->route('reservation.list')->with('fail', '刪除預約失敗！');
        }
        else {
            return redirect()->route('reservation.list')->with('success', '刪除預約成功！');
        }
    }
}