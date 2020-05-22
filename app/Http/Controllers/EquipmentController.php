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

    public function getEdit($id){
        $equipment = Equipment::find($id);

        return view('equipment.edit', ['equipment' => $equipment]);
    }

    public function postEdit(Request $request, $id){
        $this->validate($request, [
            'genre' => 'required',
            'item',
            'quantity' => 'required'
        ]);

        $equipment = Equipment::find($id);

        $equipment->genre = $request->input('genre');
        $equipment->item = $request->input('item');
        $equipment->quantity = $request->input('quantity');

        $equipment->save();

        return redirect()->route('equipment.list');
    }

    public function getDelete($id){
        $equipment = Equipment::find($id);

        $equipment->delete();

        return redirect()->route('equipment.list');
    }
}
