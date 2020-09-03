<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//資料庫model
use App\Equipment;
use App\RentKey;
use App\RentEquipment;
use App\Classroom;

class EquipmentController extends Controller
{
    //顯示設備清單
    public function getList(){
        //取得所有設備，並依種類、項目排列，再進行分頁
        $equipments = Equipment::orderBy('genre', 'DESC')
                                ->orderBy('item', 'ASC')
                                ->paginate(20);

        //回傳equipment.list，並附帶$equipments
        return view('equipment.list', ['equipments' => $equipments]);
    }

    //顯示新增設備頁面
    public function getAdd(){
        $genres = Equipment::all()
                            ->groupBy('genre')
                            ->keys();

        //回傳equipment.add
        return view('equipment.add', ['genres' => $genres]);
    }

    //儲存新增設備資料
    public function postAdd(Request $request){
        //輸入值驗證
        $this->validate($request, [
            'genre' => 'required|string',
            'genreOther' => 'string',
            'item' => 'required|string|unique:equipment,item',
            'quantity' => 'required|integer'
        ]);

        //建立model以儲存資料
        $equipment = new Equipment([
            'genre' => ($request->input('genre') === '新增設備種類')? trim($request->input('genreOther')) : $request->input('genre'),
            'item' => trim($request->input('item')),
            'quantity' => trim($request->input('quantity'))
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

        $genres = Equipment::all()
                            ->groupBy('genre')
                            ->keys();

        //回傳equipment.edit，並附帶$equipment
        return view('equipment.edit', ['equipment' => $equipment, 'genres' => $genres]);
    }

    //更新編輯過的設備資料
    public function postEdit(Request $request, $id){
        //輸入值驗證
        $this->validate($request, [
            'genre' => 'required|string',
            'genreOther' => 'string',
            'item' => 'required|string|unique:equipment,item,' . $id,
            'quantity' => 'required|integer'
        ]);

        //依傳入$id取得資料
        $equipment = Equipment::find($id);

        //更新資料
        $equipment->genre = ($request->input('genre') === '新增設備種類')? trim($request->input('genreOther')) : $request->input('genre');
        $equipment->item = trim($request->input('item'));
        $equipment->quantity = trim($request->input('quantity'));
        $executed = $equipment->save();

        //重導至equipment.list，如果更新成功則回傳成功訊息，否則回傳失敗訊息
        if($executed){
            return redirect()->route('equipment.list')->with('success', '修改設備成功！');
        }
        else{
            return redirect()->route('equipment.list')->with('fail', '修改設備失敗，請再次嘗試！');
        }
    }

    //設備借用紀錄查詢
    public function getRecord(Request $request){
        //取出所有在equipment table裡的資料，依genre分類
        $equipments = Equipment::all()
                                ->groupBy('genre');
        
        //把$equipments中的array元素依item分類，並更改其索引值為item，並只取出索引值
        foreach($equipments as $key => $value){
            $equipments[$key] = $value->sortBy('item')
                                        ->keyBy('item')
                                        ->keys();
        }
        //把資料型態從Collection object變成array
        $equipments = $equipments->toArray();

        //取出教室名
        $classroomNames = Classroom::pluck('classroomName');

        $keys = [];
        //建立各教室鑰匙種類
        foreach($classroomNames as $classroomName){
            $keys[$classroomName . '鑰匙'] = ['主要鑰匙', '服務學習鑰匙', '備用鑰匙', '備備用鑰匙'];
        }

        //合併鑰匙清單及設備清單
        $equipments = array_merge($keys, $equipments);

        if(preg_match("/鑰匙$/", $request->input('genre'))) {
            $records = RentKey::where('classroom', str_replace('鑰匙', "", $request->input('genre')))
                                ->where('key_type', $request->input('item'))
                                ->join('applications', 'application_id', '=', 'applications.id')
                                ->orderBy('rent_keys.updated_at', 'DESC')
                                ->paginate(20)
                                ->setPath('');
        }
        else {
            $records = RentEquipment::where('genre', $request->input('genre'))
                                    ->where('item', $request->input('item'))
                                    ->join('applications', 'application_id', '=', 'applications.id')
                                    ->orderBy('rent_equipments.updated_at', 'DESC')
                                    ->paginate(20)
                                    ->setPath('');
        }

        //將查詢資料接至網址列
        $pagination = $records->appends([
            'genre' => $request->input('genre'),
            'item' => $request->input('item')
        ]);

        //將查詢內容存至session
        session()->flashInput($request->input());

        //回傳equipment.record，並附帶$equipments, $records
        return view('equipment.record', ['equipments' => $equipments, 'records' => $records]);
    }

    //刪除設備
    public function getDelete($id){
        //依傳入$id取得資料
        $equipment = Equipment::find($id);

        $executed = $equipment->delete();

        //重導至equipment.list，如果刪除成功則回傳成功訊息，否則回傳失敗訊息
        if ($executed) {
            return redirect()->back()->with('success', '刪除設備成功！');
        }
        else {
            return redirect()->back()->with('fail', '刪除設備失敗，請再次嘗試！');
        }
    }
}
