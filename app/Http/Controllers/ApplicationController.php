<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//資料數model
use App\Application;
use App\Classroom;
use App\RentEquipment;
use App\Equipment;

class ApplicationController extends Controller
{
    //顯示所有申請清單
    public function getList(){
        //將applications table裡的資料依建立時間倒序排列，20筆資料分一頁輸出
        $applications = Application::orderBy('updated_at', 'DESC')
                                    ->paginate(20);

        //送回application.list並附帶$applications
        return view('application.list', ['applications' => $applications]);
    }

    //顯示所有申請中清單
    public function getRentingList(){
        //將applications table裡借出中的資料依建立時間倒序排列，20筆資料分一頁輸出
        $applications = Application::where('all_status', '借出中')
                                    ->orderBy('updated_at', 'DESC')
                                    ->paginate(20);

        //送回application.renting_list並附帶$applications
        return view('application.renting_list', ['applications' => $applications]);
    }

    //顯示所有已歸還清單
    public function getReturnedList(){
        //將applications table裡的資料依建立時間倒序排列，20筆資料分一頁輸出
        $applications = Application::where('all_status', '已歸還')
                                    ->orderBy('updated_at', 'DESC')
                                    ->paginate(20);

        //送回application.returned_list並附帶$applications
        return view('application.returned_list', ['applications' => $applications]);
    }

    //顯示申請資料
    public function getInformation($application_id){
        //取出該筆申請資料及借用設備
        $application = Application::find($application_id);
        $rent_equipments = RentEquipment::all()
                                        ->where('application_id', $application->id)
                                        ->toArray();

        //送回application.information並附帶$application及$reant_equipments
        return view('application.information', ['application' => $application, 'rent_equipments' => $rent_equipments]);
    }

    //取得新申請頁面
    public function getNew(){
        //取出所有在classrooms table裡classroomName的資料
        $classroomNames = Classroom::pluck('classroomName')->toArray();

        //產生歸還日期
        if(Date("N") === 5 | Date("N") === 6){
            $return_time = Date("Y-m-d H:i:s", strtotime('next monday 9:00'));
        }
        else {
            $return_time = Date("Y-m-d H:i:s", strtotime('tomorrow 9:00'));
        }

        //取出所有在equipment table裡的資料，並依name排序，再依name分類
        $equipments = Equipment::all()
                                ->sortBy('genre')
                                ->groupBy('genre');
        
        //把$equipments中的array元素依item分類，並更改其索引值為item
        foreach($equipments as $key => $value){
            $equipments[$key] = $value->sortBy('item')
                                        ->keyBy('item');
        }
        //把資料型態從Collection object變成array
        $equipments = $equipments->toArray();
        
        //送回application.new並附帶$classrommNames, $equipments, $return_time
        return view('application.new', ['classroomNames' => $classroomNames, 'equipments' => $equipments, 'return_time' => $return_time]);
    }

    //存入新申請資料
    public function postNew(Request $request){
        //檢查有無借用教室或設備，若無則導回前頁面並顯示錯誤訊息
        if(is_null($request->input('wantRentChk')) && empty($request->input('genre')[0])){
            return redirect()->back()->withErrors('沒有借用教室或設備！');
        }

        //根據申請人身分對基本資料處的姓名、身分、手機/分機、抵押證件進行驗證
        if($request->input('identity') === '學生'){
            $this->validate($request, [
                'name' => 'required|string',
                'grade' => 'required|string',
                'phone' => array('required','regex: /^09\d{8}$/')
            ]);

            //根據不同證件形式進行不同驗證
            if($request->input('certificate') === '其他'){
                $this->validate($request, [
                    'certificateOther' => 'required|string'
                ]);
            }
            else {
                $this->validate($request, [
                    'certificate' => 'required|string'
                ]);
            }
        }
        else if($request->input('identity') === '教職員') {
            $this->validate($request, [
                'name' => 'required|string',
                'identity' => 'required|string',
                'phone' => array('required', 'regex: /^\d{5}$/')
            ]);
        }

        //根據是否借用教室進行驗證
        if(!is_null($request->input('wantRentChk'))){
            $this->validate($request, [
                'classroom' => 'required|string',
                'key_type' => 'required|string'
            ]);
        }

        //根據是否借用設備進行驗證
        if(!empty($request->input('genre'))){
            $this->validate($request, [
                'genre' => 'required|array',
                'genre.*' => 'required|string',
                'item' => 'required|array',
                'item.*' => 'required|string',
                'quantity' => 'required|array',
                'quantity.*' => 'required|integer',
                'usage' => 'required|array',
                'usage.*' => 'required|string'
            ]);
        }

        //建立Model物件以存入資料庫
        $application = new Application([
            'name' => $request->input('name'),
            'return_time' => Date('Y-m-d H:i:s', strtotime($request->input('return_time')))
        ]);

        //根據身分填入資料
        if ($request->input('identity') === "學生") {
            $application->identity = $request->input('grade');
            $application->phone = $request->input('phone');

            //根據證件填入資料
            if($request->input('certificate') === '其他'){
                $application->certificate = $request->input('certificateOther');
            }
            else {
                $application->certificate = $request->input('certificate');
            }
        }
        else if ($request->input('identity') === "教職員") {
            $application->identity = $request->input('identity');
            $application->phone = $request->input('phone');
        }

        //根據是否借用教室填入資料
        if (!is_null($request->wantRentChk)) {
            $application->classroom = $request->input('classroom');
            $application->key_type = $request->input('key_type');
            $application->teacher = ($request->input('teacher') === "") ? '無' : $request->input('teacher');
            $application->key_status = '申請中';
        }
        else {
            $application->key_status = '無';
        }
        $executed = $application->save();

        //如果未成功存入則重導至application.list並附帶失敗訊息
        if(!$executed){
            return redirect()->route('application.list')->with('fail', '新增申請失敗！');
        }

        //根據有無借用設備執行
        if(!empty($request->input('genre')[0])){
            //將每筆設備借用分開儲存，使用$application->id作為FK
            for ($i = 0; $i < count($request->input('genre')); $i++) {
                $equipment = new RentEquipment([
                    'application_id' => $application->input('id'),
                    'genre' => $request->input('genre')[$i],
                    'item' => $request->input('item')[$i],
                    'quantity' => $request->input('quantity')[$i],
                    'usage' => $request->input('usage')[$i],
                    'remark' => ($request->input('remark')[$i] === "") ? '無' : $request->input('remark')[$i],
                    'status' => '申請中'
                ]);
                $executed = $equipment->save();

                //如果儲存失敗則將同期資料刪除，重導至application.list並附帶失敗訊息
                if(!$executed){
                    $equipments = RentEquipment::where('application_id', $application->id);
                    $equipments->delete();

                    $application = Application::find($application->id);
                    $application->delete();

                    return redirect()->route('application.list')->with('fail', '新增申請失敗！');
                }
            }
        }

        //重導至application.list並附帶成功訊息
        return redirect()->route('application.list')->with('success', '新增申請成功！');
    }

    //取得申請資料以供更新
    public function getEdit($application_id) {
        //取出所有教室名稱
        $classroomNames = Classroom::pluck('classroomName')
                                    ->toArray();

        //取出所有在equipment table裡的資料，並依genre排序，再依genre分類
        $equipments = Equipment::all()
                                ->sortBy('genre')
                                ->groupBy('genre');
        //把$equipments中的array元素依item分類，並更改其索引值為item
        foreach($equipments as $key => $value){
            $equipments[$key] = $value->sortBy('item')
                                        ->keyBy('item');
        }
        //把資料型態從Collection object變成array
        $equipments = $equipments->toArray();

        //根據傳入的$application_id取出資料
        $application = Application::find($application_id);
        //用FK application_id取出所有借用設備的資料
        $rent_equipments = RentEquipment::all()
                                        ->where('application_id', $application->id)
                                        ->toArray();

        //回傳application.edit，並附帶$application, $classroomNames, $equipments, $rent_equipments
        return view('application.edit', ['application' => $application, 'classroomNames' => $classroomNames, 'equipments' => $equipments, 'rent_equipments' => $rent_equipments]);
    }

    //更新申請資料
    public function postEdit(Request $request, $application_id) {
        //檢查有無借用教室或設備，若無則導回前頁面並顯示錯誤訊息
        if(is_null($request->input('wantRentChk')) && empty($request->input('genre')[0])){
            return redirect()->back()->withErrors('沒有借用教室或設備');
        }

        //根據申請人身分對基本資料處的姓名、身分、手機/分機、抵押證件進行驗證
        if($request->input('identity') === '學生'){
            $this->validate($request, [
                'name' => 'required|string',
                'grade' => 'required|string',
                'phone' => array('required','regex: /^09\d{8}$/')
            ]);

            //根據不同證件形式進行不同驗證
            if($request->input('certificate') === '其他'){
                $this->validate($request, [
                    'certificateOther' => 'required|string'
                ]);
            }
            else {
                $this->validate($request, [
                    'certificate' => 'required|string'
                ]);
            }
        }
        else if($request->input('identity') === '教職員') {
            $this->validate($request, [
                'name' => 'required|string',
                'identity' => 'required|string',
                'phone' => array('required', 'regex: /^\d{5}$/')
            ]);
        }
        
        //根據是否借用教室進行驗證
        if(!is_null($request->input('wantRentChk'))){
            $this->validate($request, [
                'classroom' => 'required|string',
                'key_type' => 'required|string'
            ]);
            //如果鑰匙狀態不符規範則重導回上一頁並附帶錯誤訊息
            if($request->input('key_status') != '申請中' && $request->input('key_status') != '借出中' && $request->input('key_status') != '已歸還'){
                return redirect()->back()->withErrors('無效的鑰匙狀態');
            }
        }

        //根據是否借用設備進行驗證
        if(!empty($request->input('genre'))){
            $this->validate($request, [
                'genre' => 'required|array',
                'genre.*' => 'required|string',
                'quantity' => 'required|array',
                'quantity.*' => 'required|integer',
                'usage' => 'required|array',
                'usage.*' => 'required|string',
                'status' => 'required|array',
                'status.*' => 'required|string'
            ]);
            //如果設備狀態不符規範則重導回前一頁面並附帶失敗訊息
            for($i = 0; $i < count($request->input('status')); $i++){
                if($request->input('status')[$i] != '申請中' && $request->input('status')[$i] != '借出中' && $request->input('status')[$i] != '已歸還'){
                    return redirect()->back()->withErrors('無效的設備狀態');
                }
            }
        }

        //依傳入的$application_id取出資料
        $application = Application::find($application_id);
        //用FK application_id取出所有借用設備的id
        $rent_equipments_id = RentEquipment::all()
                                            ->where('application_id', $application->id)
                                            ->pluck(['id'])
                                            ->toArray();

        //更新申請資料
        $application->name = $request->input('name');
        $application->return_time = Date('Y-m-d H:i:s', strtotime($request->input('return_time')));

        //根據身分更新資料
        if ($request->input('identity') === "學生") {
            $application->identity = $request->input('grade');
            $application->phone = $request->input('phone');

            //根據證件更新資料
            if($request->input('certificate') === '其他'){
                $application->certificate = $request->input('certificateOther');
            }
            else {
                $application->certificate = $request->input('certificate');
            }
        }
        else if ($request->input('identity') === "教職員") {
            $application->identity = $request->input('identity');
            $application->phone = $request->input('phone');
            $application->identity = null;
        }

        //根據是否借用教室更新資料
        if (!is_null($request->wantRentChk)) {
            $application->classroom = $request->input('classroom');
            $application->key_type = $request->input('key_type');
            $application->teacher = ($request->input('teacher') === "") ? '無' : $request->input('teacher');
            $application->key_status = $request->input('key_status');
        }
        else {
            $application->classroom = null;
            $application->key_type = null;
            $application->teacher = null;
            $application->key_status = null;
        }

        //更新借用設備資料
        if(!is_null($request->input('genre'))){
            for($i = 0; $i < count($request->input('genre')); $i++){
                //如果還有舊資料列可供更新則優先使用，如果借用設備比原本多則建立新的model存入資料庫
                if(count($rent_equipments_id) > 0){
                    //取出借用設備資料
                    $rent_equipment = RentEquipment::find($rent_equipments_id[0]);

                    //更新借用設備資料
                    $rent_equipment->genre = $request->input('genre')[$i];
                    $rent_equipment->item = $request->input('item')[$i];
                    $rent_equipment->quantity = $request->input('quantity')[$i];
                    $rent_equipment->usage = $request->input('usage')[$i];
                    $rent_equipment->remark = ($request->input('remark')[$i] === "") ? '無' : $request->input('remark')[$i];
                    $rent_equipment->status = $request->input('status')[$i];

                    $executed = $rent_equipment->save();

                    //若未成功儲存則重導至application.list，並附帶失敗訊息
                    if(!$executed){
                        return redirect()->route('application.list')->with('fail', '修改申請失敗，請再次嘗試！');
                    }

                    //將更新過的資料列id從紀錄未更新資料列id的陣列中移除
                    unset($rent_equipments_id[0]);
                }
                else {
                    //建立model以存入資料
                    $rent_equipment = new RentEquipment([
                        'application_id' => $application->id,
                        'genre' => $request->input('genre')[$i],
                        'item' => $request->input('item')[$i],
                        'quantity' => $request->input('quantity')[$i],
                        'usage' => $request->input('usage')[$i],
                        'remark' => ($request->input('remark')[$i] === "") ? '無' : $request->input('remark')[$i],
                        'status' => $request->input('status')[$i]
                    ]);
                    $executed = $rent_equipment->save();

                    //若未成功儲存則重導至application.list，並附帶失敗訊息
                    if(!$executed){
                        return redirect()->route('application.list')->with('fail', '修改申請失敗，請再次嘗試！');
                    }
                }
            }
        }

        //如果仍有未更新資料列的id存在則將其全數移除
        if(!empty($rent_equipments_id)){
            foreach($rent_equipments_id as $rent_equipment_id){
                $rent_equipment = RentEquipment::find($rent_equipment_id);

                $executed = $rent_equipment->delete();

                //若未成功刪除則重導至application.list，並附帶失敗訊息
                if(!$executed){
                    return redirect()->route('application.list')->with('fail', '修改申請失敗，請再次嘗試！');
                }
            }
        }

        //用FK application_id取出所有借用設備的狀態，並轉成陣列型態
        $rent_equipments_status = RentEquipment::all()
                                            ->where('application_id', $application->id)
                                            ->pluck(['status'])
                                            ->toArray();
        //更新整筆申請的狀態
        if($application->key_status === '已歸還' && !in_array('借出中', $rent_equipments_status)){
            $application->all_status = '已歸還';
        }
        else if($application->key_status === '借出中' || in_array('借出中', $rent_equipments_status)){
            $application->all_status = '借出中';
        }
        else if($application->key_status === '申請中'){
            if(!in_array('借出中', $rent_equipments_status) && !in_array('已歸還', $rent_equipments_status)){
                $application->all_status = '申請中';
            }
            else if (!in_array('借出中', $rent_equipments_status) && in_array('已歸還', $rent_equipments_status)){
                $application->all_status = '已歸還';
            }
        }
        $executed = $application->save();

        //重導至application.list，若更新失敗則附帶失敗訊息，若更新成功附帶成功訊息
        if(!$executed){
            return redirect()->route('application.list')->with('fail', '修改申請失敗，請再次嘗試！');
        }
        else {
            return redirect()->route('application.list')->with('success', '修改申請成功！');
        }
    }

    //取得可借出設備資料
    public function getRent($application_id){
        //依傳入的$application_id取出資料
        $application = Application::find($application_id);
        //用FK application_id取出所有尚未借出或歸還的借用設備資料
        $rent_equipments = RentEquipment::all()
                                        ->where('application_id', $application->id)
                                        ->where('status', '申請中')
                                        ->toArray();

        //回傳application.rent，並附帶$application, $rent_equipments
        return view('application.rent', ['application' => $application, 'rent_equipments' => $rent_equipments]);
    }

    //設備借出資料更新
    public function postRent(Request $request, $application_id) {
        //依傳入的$application_id取出資料
        $application = Application::find($application_id);
        //用FK application_id取出所有借用設備的id
        $rent_equipments_id = RentEquipment::all()
                                            ->where('application_id', $application->id)
                                            ->pluck(['id'])
                                            ->toArray();

        //依序更新借出的設備資料
        foreach($request->input('rent') as $id){
            //若$id是key則代表借出教室鑰匙，其餘皆是借用設備資料的id
            if($id === 'key'){
                $application->key_status = '借出中';
            }
            //如果資料庫中確實有借用該設備的申請則更新資料
            elseif(in_array($id, $rent_equipments_id)){
                //以$id取出資料
                $rent_equipment = RentEquipment::find($id);

                $rent_equipment->status = '借出中';

                $executed = $rent_equipment->save();

                //若未成功借出則重導至application.list，並附帶失敗訊息
                if(!$executed) {
                    return redirect()->route('application.list')->with('fail', '設備借出失敗，請再次嘗試！');
                }
            }
        }

        //將整筆申請的狀態改為借出中
        $application->all_status = '借出中';

        $executed = $application->save();

        if(!$executed) {
            //若未成功借出則附帶失敗訊息重導至application.list
            return redirect()->route('application.list')->with('fail', '設備借出失敗，請再次嘗試！');
        }
        else{
            //若成功借出則附帶成功訊息重導至application.renting_list
            return redirect()->route('application.renting_list')->with('success', '設備借出成功！');
        }
    }

    //取得可歸還設備資料
    public function getReturn($application_id){
        //依傳入的$application_id取出資料
        $application = Application::find($application_id);
        //用FK application_id取出所有借出中的借用設備資料，並轉成陣列型態
        $rent_equipments = RentEquipment::all()
                                        ->where('application_id', $application->id)
                                        ->where('status', '借出中')
                                        ->toArray();

        //回傳application.return，並附帶$application, $rent_equipments
        return view('application.return', ['application' => $application, 'rent_equipments' => $rent_equipments]);
    }

    //設備歸還資料更新
    public function postReturn(Request $request, $application_id) {
        //依傳入的$application_id取出資料
        $application = Application::find($application_id);
        //用FK application_id取出所有借用設備資料，並轉成陣列型態
        $rent_equipments_id = RentEquipment::all()
                                            ->where('application_id', $application->id)
                                            ->pluck(['id'])
                                            ->toArray();

        //依序更新歸還的設備資料
        foreach($request->input('return') as $id){
            //若$id是key則代表歸還教室鑰匙，其餘皆是借用設備資料的id
            if($id === 'key'){
                $application->key_status = '已歸還';
            }
            //如果資料庫中確實有借用該設備的申請則更新資料
            elseif(in_array($id, $rent_equipments_id)){
                $rent_equipment = RentEquipment::find($id);

                $rent_equipment->status = '已歸還';

                $executed = $rent_equipment->save();

                //若未成功歸還則重導至application.list，並附帶失敗訊息
                if(!$executed) {
                    return redirect()->route('application.list')->with('fail', '設備歸還失敗，請再次嘗試！');
                }
            }
        }

        //用FK application_id取出所有借用設備的狀態，並轉成陣列型態
        $rent_equipments_status = RentEquipment::all()
                                                ->where('application_id', $application->id)
                                                ->pluck(['status'])
                                                ->toArray();

        //更新整筆申請的狀態
        if($application->key_status === '已歸還' && !in_array('借出中', $rent_equipments_status)){
            $application->all_status = '已歸還';
        }

        $executed = $application->save();

        //重導至application.list，若未成功歸還則附帶失敗訊息，若成功歸還則附帶成功訊息
        if(!$executed) {
            //若未成功歸還則附帶失敗訊息重導至application.list
            return redirect()->route('application.list')->with('fail', '設備歸還失敗，請再次嘗試！');
        }
        else{
            //若成功歸還則附帶成功訊息重導至application.returned_list
            return redirect()->route('application.returned_list')->with('success', '設備歸還成功！');
        }
    }

    //刪除申請
    public function getDelete($application_id){
        //依傳入的$application_id取出資料
        $application = Application::find($application_id);
        //用FK application_id取出所有借用設備資料
        $rent_equipments = RentEquipment::where('application_id', $application->id);

        //如果有借用設備則優先刪除借用設備資料
        if(!empty($rent_equipments)){
            $executed = $rent_equipments->delete();

            //若未成功刪除則重導至application.list，並附帶失敗訊息
            if(!$executed) {
                return redirect()->route('application.list')->with('fail', '刪除申請失敗，請再次嘗試！');
            }
        }

        $executed = $application->delete();

        //重導至application.list，若未成功刪除則附帶失敗訊息，若成功刪除則附帶成功訊息
        if(!$executed) {
            return redirect()->route('application.list')->with('fail', '刪除申請失敗，請再次嘗試！');
        }
        else {
            return redirect()->route('application.list')->with('success', '申請刪除成功！');
        }
    }
}
