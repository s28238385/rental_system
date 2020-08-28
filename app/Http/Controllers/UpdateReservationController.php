<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Reservation;

class UpdateReservationController extends Controller
{
    public function update(){
        $ids = Reservation::pluck('id');

        foreach($ids as $id){
            $reservation = Reservation::find($id);

            if(preg_match('/09\d{8}$/', $reservation->name)){
                $reservation->phone = substr($reservation->name, -10, 10);
                $reservation->name = substr_replace($reservation->name, "", -10);

                $executed = $reservation->save();

                if(!$executed){
                    return redirect()->route('reservation.list')->with('fail', '更新失敗！');
                }
            }
        }

        return redirect()->route('reservation.list')->with('success', '更新成功！');
    }
}
