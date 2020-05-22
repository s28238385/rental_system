@extends ('layout')

@section('content')

<script type="text/javascript" src="{{ URL::asset('js/newapply.js') }}"></script>

<div class="container pt-3">
    <h1>@顯示借用器材規則畫面</h1>
    <div id="ruleSection">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum ad unde delectus, ut exercitationem eos? Id
            quia
            enim assumenda ullam natus quidem corrupti suscipit provident beatae, doloribus soluta mollitia ducimus.</p>
        <button type="button" class="btn btn-success" id="agreeBtn">同意</button>
    </div>


    <div class="card p-3">

        <h2 class="text-primary">基本資料</h2>
        {!!Form::open(['action' => 'ApplyController@store']) !!}
        <div class="form-row">

            {{-- 姓名:name --}}
            <div class="form-group col-md-3">
                {!!Form::label('name', '姓名') !!}
                {!!Form::text('name', old('name'), ['class'=>'form-control']) !!}
            </div>

            {{-- 身分:identity --}}
            <div class="form-group col-md-3">
                {!!Form::label('identity', '身分') !!}
                {!!Form::select('identity', $identity['options'], 0, ['class' => 'form-control']) !!}
            </div>

            {{-- 學部: .degree --}}
            <div class="form-group col-md-3 degree">
                {!!Form::label('degree', '學部') !!}
                {!!Form::select('degree', $identity['degree']['options'], 0, ['class' =>
                'form-control']) !!}
            </div>

            {{-- 班年級:grade .grade--}}
            <div class="form-group col-md-3 grade">
                {!!Form::label('grade', '年級') !!}
                <select name='"grade"' id="grade" class=" form-control">
                </select>
            </div>
        </div>

        <div class="form-row">

            {{-- 抵押證件 --}}
            <div class="form-group col-md-3">
                {!!Form::label('card', '抵押證件') !!}
                {!!Form::select('card', $card['options'], 0, ['class' => 'form-control']) !!}
            </div>

            {{-- 分機或手機 --}}
            <div class="form-group col-md-3">
                {!!Form::label('phone', '') !!}
                {!!Form::text('phone', old('phone'), ['class' => 'form-control']) !!}
            </div>

        </div>

        <div class="form-check pt-1">

            {{-- 按鈕：是否借用教室 --}}
            <input class="form-check-input" type="checkbox" value="" id="wantRentChk" name="wantRentChk">
            <label class="form-check-label" for="wantRentChk">
                是否借用教室
            </label>
        </div>
    </div>



    {{-- 教室選擇列表
	教室string
	鑰匙種類string
    授課教師string --}}
    <div class="card p-3 mt-3 d-none" id="classroomSection">
        <h2 class="text-primary">教室選擇列表</h2>
        <div class="form-row">
            <div class="form-group col-md-3">
                {!!Form::label('classroom', '借用教室') !!}
                {!!Form::select('classroom', $classroom['options'], 0, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group col-md-3">
                {!!Form::label('key_type', '鑰匙種類') !!}
                {!!Form::select('key_type', $key_type['options'], 0, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group col-md-3">
                {!!Form::label('teacher', '授課教師') !!}
                {!!Form::text('teacher', old('teacher'), ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>

    {{-- 設備
    借用設備種類string
    借用項目string
    （什麼項目？
    借用數量tinyint
    用途string
    預計歸還日期datetime
    備註string

    是否借用更多

    申請時間timestamp --}}

    <div class="card p-3 mt-3">
        <h2 class="text-primary">借用設備</h2>

        <div class="equipmentContainer">
            <div id="equipment">
                <div class="d-flex py-3 align-items-center">
                    <div class="text-info col-1">
                        <h4 id="equipmentNum">1</h4>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm" id="dltBtn">刪除</button>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        {!!Form::label('equipment_type[]', '借用設備種類') !!}
                        {!!Form::select('equipment_type[]', $equipment_type['options'], 0, ['class' =>
                        'form-control'])
                        !!}
                    </div>
                    <div class="form-group col-md-3">
                        {!!Form::label('equipment_name[]', '借用設備名稱') !!}
                        {!!Form::select('equipment_name[]', $equipment['options'], 0, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-md-3">
                        {!!Form::label('equipment_num[]', '借用數量') !!}
                        {!!Form::selectRange('equipment_num[]', 1, 5, 0, ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        {!!Form::label('usage[]', '用途') !!}
                        {!!Form::text('usage[]', old('usage'), ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group col-md-3">
                        {!!Form::label('return_time[]', '歸還時間') !!}
                        {!!Form::text('return_time[]', '', array('class' => 'form-control','id' => 'datepicker')) !!}
                    </div>
                    <div class="form-group col-md-3">
                        {!!Form::label('remark[]', '備註') !!}
                        {!!Form::text('remark[]', old('remark'), ['class'=>'form-control']) !!}
                    </div>
                </div>
                <hr>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <button type="button" class="btn btn-success" id="moreBtn" name="moreBtn">借用更多</button>
            </div>
        </div>
    </div>

    <div class="card border-0 my-3">
        {!!Form::submit('送出', ['class' =>'form-control btn btn-warning']) !!}
    </div>

    {!!Form::close() !!}

</div>
@endsection