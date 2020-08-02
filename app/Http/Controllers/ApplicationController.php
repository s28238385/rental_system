<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Application;

use App\SearchingClassroom;

use App\RentEquipment;

use App\Equipment;

class ApplicationController extends Controller
{
    public function getList(){
        //取出所有在applications table裡的資料
        $applications = Application::all()->sortByDesc('created_at');

        //送回application.list並附帶$applications
        return view('application.list', ['applications' => $applications]);
    }

    public function getInformation($application_id){
        $application = Application::find($application_id);
        $rent_equipments = RentEquipment::all()->where('application_id', $application->id)->toArray();

        //dd($rent_equipments);

        return view('application.information', ['application' => $application, 'rent_equipments' => $rent_equipments]);
    }

    public function getNew(){
        //取出所有在searching_classrooms table裡classroomName的資料
        $classroomNames = SearchingClassroom::all(['classroomName'])->pluck('classroomName')->toarray();

        //產生歸還日期
        if(Date("N") == 5){
            $return_time = Date("Y-m-d H:i", strtotime('next monday 9:00'));
        }
        else {
            $return_time = Date("Y-m-d H:i", strtotime('tomorrow 9:00'));
        }

        //取出所有在equipment table裡的資料，並依name排序，再依name分類
        $equipments = Equipment::all()->sortBy('name')->groupBy('name');
        
        //把$equipments中的array元素依index分類，並更改其索引值為index
        foreach($equipments as $key => $value){
            $equipments[$key] = $value->sortBy('index')->keyBy('index');
        }
        //把資料型態從Collection object變成array
        $equipments = $equipments->toArray();
        
        //送回application.new並附帶$classrommNames, $equipments
        return view('application.new', ['classroomNames' => $classroomNames, 'equipments' => $equipments, 'return_time' => $return_time]);
    }

    public function postNew(Request $request){
        //檢查有無借用教室或設備
        if(is_null($request->input('wantRentChk')) && empty($request->equipment_name[0])){
            return redirect()->back()->withError('沒有借用教室或設備！');
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
        if(!is_null($request->equipment_name[0])){
            $this->validate($request, [
                'equipment_name' => 'required|array',
                'equipment_name.*' => 'required|string',
                'quantity' => 'required|array',
                'quantity.*' => 'required|integer',
                'usage' => 'required|array',
                'usage.*' => 'required|string'
            ]);
        }

        $application = new Application([
            'name' => $request->input('name'),
            'return_time' => date_create_from_format('Y-m-d H:i', implode($request->input('return_time'),""))
        ]);
        
        if ($request->input('identity') === "學生") {
            $application->identity = $request->input('grade');
            $application->phone = $request->input('phone');
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
        else {
            return redirect()->back()->withError('聯絡號碼格式不符');
        }
        
        if (!is_null($request->wantRentChk)) {
            $application->classroom = $request->input('classroom');
            $application->key_type = $request->input('key_type');
            $application->teacher = ($request->teacher === "") ? '無' : $request->input('teacher');
            $application->key_status = '已建立';
        }
        $executed = $application->save();

        if(!$executed){
            return redirect('/')->with('fail', '新增申請失敗！');
        }

        if(!empty($request->equipment_name[0])){
            for ($i = 0; $i < count($request->input('equipment_name')); $i++) {
                $equipment = new RentEquipment([
                    'application_id' => $application->id,
                    'name' => $request->equipment_name[$i],
                    'index' => $request->index[$i],
                    'quantity' => $request->quantity[$i],
                    'usage' => $request->usage[$i],
                    'remark' => ($request->remark[$i] === "") ? '無' : $request->remark[$i],
                    'status' => '已建立'
                ]);
                $executed = $equipment->save();

                if(!$executed){
                    $equipments = RentEquipment::where('application_id', $application->id)->toArray();
                    foreach($equipments as $equipment){
                        $equipment->delete();
                    }

                    $application->delete();

                    return redirect('/')->with('fail', '新增申請失敗！');
                }
            }
        }
        

        if($executed){
            return redirect()->route('application.list')->with('success', '新增申請成功！');
        }
    }

    public function getEdit($application_id) {
        $application = Application::find($application_id);
        $classroomNames = SearchingClassroom::all(['classroomName'])->pluck('classroomName')->toarray();

        //取出所有在equipment table裡的資料，並依name排序，再依name分類
        $equipments = Equipment::all()->sortBy('name')->groupBy('name');
        
        //把$equipments中的array元素依index分類，並更改其索引值為index
        foreach($equipments as $key => $value){
            $equipments[$key] = $value->sortBy('index')->keyBy('index');
        }
        //把資料型態從Collection object變成array
        $equipments = $equipments->toArray();

        $rent_equipments = RentEquipment::all()->where('application_id', $application->id)->toArray();

        //dd($application_id);
        return view('application.edit', ['application' => $application, 'classroomNames' => $classroomNames, 'equipments' => $equipments, 'rent_equipments' => $rent_equipments]);
    }

    public function postEdit(Request $request, $application_id) {
        //檢查有無借用教室或設備
        if(is_null($request->input('wantRentChk')) && empty($request->equipment_name[0])){
            return redirect()->back()->withError('沒有借用教室或設備！');
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
        if(!is_null($request->equipment_name[0])){
            $this->validate($request, [
                'equipment_name' => 'required|array',
                'equipment_name.*' => 'required|string',
                'quantity' => 'required|array',
                'quantity.*' => 'required|integer',
                'usage' => 'required|array',
                'usage.*' => 'required|string'
            ]);
        }

        $application = Application::find($application_id);
        $rent_equipments = RentEquipment::all()->where('application_id', $application->id)->pluck(['id'])->toArray();
        //dd($rent_equipments);
        

        $application->name = $request->input('name');
        $application->return_time = date_create_from_format('Y-m-d H:i', implode($request->input('return_time'),""));

        if ($request->input('identity') === "學生") {
            $application->identity = $request->input('grade');
            $application->phone = $request->input('phone');
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
        else {
            return redirect()->back()->withError('聯絡號碼格式不符');
        }
        
        if (!is_null($request->wantRentChk)) {
            $application->classroom = $request->input('classroom');
            $application->key_type = $request->input('key_type');
            $application->teacher = ($request->teacher === "") ? '無' : $request->input('teacher');
        }
        $executed = $application->save();

        if(!$executed){
            return redirect('/')->with('fail', '修改申請失敗，請再次嘗試！');
        }

        if(count($rent_equipments) < count($request->input('equipment_name'))){
            for ($i = 0; $i < count($rent_equipments); $i++) {
                $rent_equipment = RentEquipment::find($rent_equipments[$i]);

                $rent_equipment->name = $request->equipment_name[$i];
                $rent_equipment->index = $request->index[$i];
                $rent_equipment->quantity = $request->quantity[$i];
                $rent_equipment->usage = $request->usage[$i];
                $rent_equipment->remark = ($request->remark[$i] === "") ? '無' : $request->remark[$i];

                $executed = $rent_equipment->save();

                if(!$executed){
                    return redirect('/')->with('fail', '修改申請失敗，請再次嘗試！');
                }
            }

            for ($i = count($rent_equipments); $i < count($request->input('equipment_name')); $i++) {
                $rent_equipment = new RentEquipment([
                    'application_id' => $application->id,
                    'name' => $request->equipment_name[$i],
                    'index' => $request->index[$i],
                    'quantity' => $request->quantity[$i],
                    'usage' => $request->usage[$i],
                    'remark' => ($request->remark[$i] === "") ? '無' : $request->remark[$i],
                    'status' => '已建立'
                ]);
                $executed = $rent_equipment->save();

                if(!$executed){
                    return redirect('/')->with('fail', '修改申請失敗，請再次嘗試！');
                }
            }
        }
        else if(count($rent_equipments) > count($request->input('equipment_name'))) {
            for ($i = 0; $i < count($request->input('equipment_name')); $i++) {
                $rent_equipment = RentEquipment::find($rent_equipments[$i]);

                $rent_equipment->name = $request->equipment_name[$i];
                $rent_equipment->index = $request->index[$i];
                $rent_equipment->quantity = $request->quantity[$i];
                $rent_equipment->usage = $request->usage[$i];
                $rent_equipment->remark = ($request->remark[$i] === "") ? '無' : $request->remark[$i];

                $executed = $rent_equipment->save();

                if(!$executed){
                    return redirect('/')->with('fail', '修改申請失敗，請再次嘗試！');
                }
            }

            for($i = count($request->input('equipment_name')); $i < count($rent_equipments); $i++) {
                $rent_equipment = RentEquipment::find($rent_equipments[$i]);

                $executed = $rent_equipment->delete();

                if(!$executed){
                    return redirect('/')->with('fail', '修改申請失敗，請再次嘗試！');
                }
            }
        }
        else {
            for ($i = 0; $i < count($request->input('equipment_name')); $i++) {
                $rent_equipment = RentEquipment::find($rent_equipments[$i]);

                $rent_equipment->name = $request->equipment_name[$i];
                $rent_equipment->index = $request->index[$i];
                $rent_equipment->quantity = $request->quantity[$i];
                $rent_equipment->usage = $request->usage[$i];
                $rent_equipment->remark = ($request->remark[$i] === "") ? '無' : $request->remark[$i];

                $executed = $rent_equipment->save();

                if(!$executed){
                    return redirect('/')->with('fail', '修改申請失敗，請再次嘗試！');
                }
            }
        }

        if($executed){
            return redirect()->route('application.list')->with('success', '修改申請成功！');
        }
    }

    public function getDelete($application_id){
        $application = Application::find($application_id);
        $rent_equipments = RentEquipment::where('application_id', $application->id);

        if(!empty($rent_equipments)){
            $executed = $rent_equipments->delete();

            if(!$executed) {
                return redirect()->route('application.list')->with('fail', '刪除申請失敗，請再次嘗試！');
            }
            
        }

        $executed = $application->delete();
        if(!$executed) {
            return redirect()->route('application.list')->with('fail', '刪除申請失敗，請再次嘗試！');
        }
        else {
            return redirect()->route('application.list')->with('success', '申請刪除成功！');
        }
    }
}
