<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//資料庫model
use App\Equipment;

class EquipmentController extends Controller
{
    //顯示設備清單
    public function getList(){
        //取得所有設備，並依種類、項目排列
        $equipments = Equipment::orderBy('genre', 'ASC')
                                ->orderBy('item', 'ASC')
                                ->paginate(20);

        //回傳equipment.list，並附帶$equipments
        return view('equipment.list', ['equipments' => $equipments]);
    }

    //顯示新增設備頁面
    public function getAdd(){
        //回傳equipment.add
        return view('equipment.add');
    }

    //儲存新增設備資料
    public function postAdd(Request $request){
        //輸入值驗證
        $this->validate($request, [
            'genre' => 'required|string',
            'item' => 'required|string',
            'quantity' => 'required|integer'
        ]);

        //確保設備種類與項目不重複，若重複則導回前頁面並回傳錯誤訊息
        if(
            Equipment::where('genre', $request->input('genre'))
                        ->where('item', $request->input('item'))
                        ->first()
        ){
            return redirect()->back()->withErrors('已有相同的設備種類與項目組合')->withInput();
        }

        //建立model以儲存資料
        $equipment = new Equipment([
            'genre' => $request->input('genre'),
            'item' => $request->input('item'),
            'quantity' => $request->input('quantity')
        ]);
        $executed = $equipment->save();

        //重導至equipment.list，如果儲存成功則回傳成功訊息，否則回傳失敗訊息
        if($executed){
            return redirect()->route('equipment.list')->with('success', '新增設備成功！');
        }
        else{
            return redirect()->route('equipment.list')->with('fail', '新增設備失敗，請再次嘗試！');
        }
    }

    //取得編輯設備頁面
    public function getEdit($id){
        //依傳入值$id取得資料
        $equipment = Equipment::find($id);

        //回傳equipment.edit，並附帶$equipment
        return view('equipment.edit', ['equipment' => $equipment]);
    }

    //更新編輯過的設備資料
    public function postEdit(Request $request, $id){
        //輸入值驗證
        $this->validate($request, [
            'genre' => 'required|string',
            'item' => 'required|string',
            'quantity' => 'required|integer'
        ]);

        //確保設備種類與項目不重複，若重複則導回前頁面並回傳錯誤訊息
        if(
            Equipment::where('id', '<>', $id)
                        ->where('genre', $request->input('genre'))
                        ->where('item', $request->input('item'))
                        ->first()
        ){
            return redirect()->back()->withErrors('已有重複的設備與分類組合');
        }

        //依傳入$id取得資料
        $equipment = Equipment::find($id);

        //更新資料
        $equipment->genre = $request->input('genre');
        $equipment->item = $request->input('item');
        $equipment->quantity = $request->input('quantity');
        $executed = $equipment->save();

        //重導至equipment.list，如果更新成功則回傳成功訊息，否則回傳失敗訊息
        if($executed){
            return redirect()->route('equipment.list')->with('success', '修改設備成功！');
        }
        else{
            return redirect()->route('equipment.list')->with('fail', '修改設備失敗，請再次嘗試！');
        }
    }

    //刪除設備
    public function getDelete($id){
        //依傳入$id取得資料
        $equipment = Equipment::find($id);

        $executed = $equipment->delete();

        //重導至equipment.list，如果刪除成功則回傳成功訊息，否則回傳失敗訊息
        if ($executed) {
            return redirect()->route('equipment.list')->with('success', '刪除設備成功！');
        }
        else {
            return redirect()->route('equipment.list')->with('fail', '刪除設備失敗，請再次嘗試！');
        }
    }
}
