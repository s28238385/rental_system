<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Equipment;

class EquipmentController extends Controller
{
    public function getList(){
        $equipments = Equipment::all()->sortBy('item')->sortBy('genre');

        return view('equipment.list', ['equipments' => $equipments]);
    }

    public function getAdd(){
        return view('equipment.add');
    }

    public function postAdd(Request $request){
        $this->validate($request, [
            'genre' => 'required|string',
            'item' => 'required|string',
            'quantity' => 'required|integer'
        ]);

        if(Equipment::where('genre', $request->input('genre'))->where('item', $request->input('item'))->first()){
            return redirect()->back()->withErrors('已有重複的設備與分類組合');
        }

        $equipment = new Equipment([
            'genre' => $request->input('genre'),
            'item' => $request->input('item'),
            'quantity' => $request->input('quantity')
        ]);
        $executed = $equipment->save();

        if($executed){
            return redirect()->route('equipment.list')->with('success', '新增設備成功！');
        }
        else{
            return redirect()->route('equipment.list')->with('fail', '新增設備失敗！');
        }
    }

    public function getEdit($id){
        $equipment = Equipment::find($id);

        return view('equipment.edit', ['equipment' => $equipment]);
    }

    public function postEdit(Request $request, $id){
        $this->validate($request, [
            'genre' => 'required|string',
            'item' => 'required|string',
            'quantity' => 'required|integer'
        ]);

        if(Equipment::where('id', '<>', $id)->where('genre', $request->input('genre'))->where('item', $request->input('item'))->first()){
            
            return redirect()->back()->withErrors('已有重複的設備與分類組合');
        }

        $equipment = Equipment::find($id);

        $equipment->genre = $request->input('genre');
        $equipment->item = $request->input('item');
        $equipment->quantity = $request->input('quantity');
        $executed = $equipment->save();

        if($executed){
            return redirect()->route('equipment.list')->with('success', '修改設備成功！');
        }
        else{
            return redirect()->route('equipment.list')->with('fail', '修改設備失敗！');
        }
    }

    public function getDelete($id){
        $equipment = Equipment::find($id);

        $executed = $equipment->delete();

        if ($executed) {
            return redirect()->route('equipment.list')->with('success', '刪除設備成功！');
        }
        else {
            return redirect()->route('equipment.list')->with('fail', '刪除設備失敗！');
        }
    }
}
