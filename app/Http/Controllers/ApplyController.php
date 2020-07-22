<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Apply;

use App\SearchingClassroom;

use App\RentEquipment;

use App\Equipment;

use DateTime;

class ApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classroomNames = SearchingClassroom::all(['classroomName'])->pluck('classroomName')->toarray();
        $genres = Equipment::all(['genre'])->pluck('genre')->toarray();
        $items = Equipment::all(['item'])->pluck('item')->toarray();

        $attributes = [
            'name' => [
                'name' => 'name',
                'label' => '姓名'
            ],
            'identity' => [
                'name' => 'identity',
                'label' => '身分',
                'options' => [
                    '學生',
                    '教職員'
                ],
                'degree' => [
                    'name' => 'degree',
                    'label' => '學部',
                    'options' => [
                        '大學部',
                        '碩士班',
                        '碩士在職專班',
                        '博士班'
                    ],
                    'grade' => [
                        'name' => 'grade',
                        'label' => '年級',
                        'options' => [
                            '一A',
                            '一B',
                            '二A',
                            '二B',
                            '一',
                            '二',
                            '三',
                            '四',
                            '五',
                            '六',
                            '七'
                        ]
                    ]
                ]
            ],
            'card' => [
                'name' => 'card',
                'label' => '抵押證件',
                'options' => [
                    '學生證', '身分證', '健保卡', '駕照', '其他', '無'
                ]
            ],
            'phone' => [
                'name' => 'phone',
                'label' => [
                    '手機號碼', '分機'
                ]
            ],
            'classroom' => [
                'name' => 'classroom',
                'label' => '借用教室',
                'options' => $classroomNames
            ],
            'key_type' => [
                'name' => 'key_type',
                'label' => '鑰匙種類',
                'options' => []
            ],
            'teacher' => [
                'name' => 'teacher',
                'label' => '授課教師'
            ],
            'genre' => [
                'name' => 'genre',
                'label' => '借用設備種類',
                'options' => $genres
            ],
            'item' => [
                'name' => 'item',
                'label' => '借用項目',
                'options' => $items
            ],
            'equipment_num' => [
                'name' => 'equipment_num',
                'label' => '借用數量'
            ],
            'usage' => [
                'name' => 'usage',
                'label' => '用途'
            ],
            'return_time' => [
                'name' => 'return_time',
                'label' => '預計歸還時間'
            ],
            'remark' => [
                'name' => 'remark',
                'label' => '備註'
            ]
        ];

        return view('newapply', $attributes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $apply = new Apply();

        $apply->name = $request->name;
        $apply->identity = $request->identity;
        if ($request->identity == "學生") {
            // 儲存班年級、抵押證件

            // degree = 學部（例如：大學部）, grade = 年級和班級(例如：一A)
            $apply->grade = $request->degree . $request->grade;
            $apply->card = $request->card;
        }
        $apply->phone = $request->phone;

        if (!is_null($request->wantRentChk)) {
            // 借用教室
            $apply->classroom = $request->classroom;
            $apply->key_type = $request->key_type;
            // 若沒有授課老師給null
            $apply->teacher = ($request->teacher == "") ? null : $request->teacher;
        }
        $apply->save();

        for ($i = 0; $i < count($request->genre); $i++) {
            $equipment = new RentEquipment();
            $equipment->genre = $request->genre[$i];
            $equipment->item = $request->item[$i];
            $equipment->quantity = $request->quantity[$i];
            $equipment->usage = $request->usage[$i];
            $equipment->return_time = DateTime::createFromFormat('Y年m月d日 H時', $request->return_time[$i]);
            $equipment->remark = ($request->remark[$i] == "") ? null : $request->remark[$i];
            $equipment->apply_id = $apply->id;
            $equipment->save();
        }
        return 'success!!還沒有首頁QQ';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
