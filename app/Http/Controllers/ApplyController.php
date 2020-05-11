<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Apply;

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
                'options' => [
                    "I1-223",
                    "I1-002",
                    "I1-017",
                    "I1-105",
                    "I1-107",
                    "I1-404",
                    "I-314",
                    "I-315",
                ]
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
            'equipment_type' => [
                'name' => 'equipment_type',
                'label' => '借用設備種類',
                'options' => []
            ],
            'equipment' => [
                'name' => 'equipment',
                'label' => '借用項目',
                'options' => []
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


        if(is_null($request->wantRentChk)){
            dd('no check');
        }else{
            dd('checked');
        }

        // $apply->name = $request->name;
        // $apply->identity = $request->identity;
        // $apply->grade = $request->grade;
        // $apply->card = $request->card;
        // $apply->phone = $request->phone;
        // $apply->classroom = $request->classroom;
        // $apply->key_type = $request->key_type;
        // $apply->teacher = $request->teacher;
        // $apply->equipment_type = $request->equipment_type;
        // $apply->equipment = $request->equipment;
        // $apply->equipment_num = $request->equipment_num;
        // $apply->usage = $request->usage;
        // $apply->return_time = $request->return_time;
        // $apply->remark = $request->remark;



        $apply->save();
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
