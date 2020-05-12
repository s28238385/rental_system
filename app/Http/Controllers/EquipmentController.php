<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Equipment;

class EquipmentController extends Controller
{
    public function getList(){
        $equipments = Equipment::all();

        return view('equipment.list', ['equipments' => $equipments]);
    }

    public function getAdd(){
        return view('equipment.add');
    }

    public function postAdd(Request $request){
        $this->validate($request, [
            'genre' => 'required|unique:equipment',
            'item',
            'quantity' => 'required'
        ]);

        $equipment = new Equipment([
            'genre' => $request->input('genre'),
            'item' => $request->input('item'),
            'quantity' => $request->input('quantity')
        ]);
        //dd($equipment);
        $equipment->save();

        return redirect()->route('equipment.list');
    }
}
