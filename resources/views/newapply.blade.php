@extends ('layout')

@section('content')

<script>
    (function(){
            $(document).ready(function () {

                // 身分改變時
                $('#identity').change(function () {
                    // 選擇身份顯示or隱藏學部、班年級
                    $('.degree, .grade').toggleClass('d-none');

                    // 分機或手機
                    if($('#identity option:selected').text() == "學生"){
                        $('label[for="phone"]').text('手機號碼');
                    }else{
                        $('label[for="phone"]').text('分機');
                    }
                });
                $('#identity').val(0).change();

                // 選擇學部改變班年級
                $('#degree').change(function () {

                    var options_class = ['A', 'B'];
                    var options_grade = ['一', '二', '三', '四', '五', '六', '七'];
                    
                    switch ($("#degree option:selected").text()) {
                        case '大學部':
                            stop = 4;
                            break;
                        case '碩士班':
                        case '碩士在職專班':
                            stop = 2;
                            break;
                        case '博士班':
                            stop = 7;
                            break;
                    }

                    $('#grade').empty();

                    if(stop == 4){
                        for(var i = 0; i < stop; i++){
                            for(var j = 0; j < options_class.length; j++){
                                $('#grade').append(new Option(options_grade[i] + options_class[j]));
                            }
                        }
                        return;
                    }

                    for(var i = 0; i < stop; i++){
                        $('#grade').append(new Option(options_grade[i]));
                    }
                });
                // 先觸發第一次選擇
                $('#degree').val(0).change();

                // 是否借用教室的核取方塊改變時
                $('#wantRentChk').change(function () {
                    $('#classroomSection').toggleClass('d-none');
                });

                $('#phone').change(function () {

                });


                $('#moreBtn').click(function () {
                    alert('借用更多');
                });
            })
        })();

</script>


<div class="container pt-3">
    <h1>@顯示借用器材規則畫面</h1>
    <div id="ruleSection">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum ad unde delectus, ut exercitationem eos? Id
            quia
            enim assumenda ullam natus quidem corrupti suscipit provident beatae, doloribus soluta mollitia ducimus.</p>
        <button type="button" class="btn btn-success" onclick="showForm()">同意</button>
    </div>


    <div class="card p-3">
        {{-- 基本資料
	姓名string
	身分string
	抵押證件string
	電話（分機或手機varchar

是否借用教室？ --}}



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

        <div class="contianer">
            <div class="d-flex py-3 align-items-center">
                <div class="text-info col-1">
                    <h4 id="numEquipment">num</h4>
                </div>
                <button type="button" class="btn btn-danger btn-sm" btn-lg btn-block">刪除</button>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    {!!Form::label('equipment_type', '借用設備種類') !!}
                    {!!Form::select('equipment_type', $equipment_type['options'], 0, ['class' =>
                    'form-control'])
                    !!}
                </div>
                <div class="form-group col-md-3">
                    {!!Form::label('equipment_name', '借用設備名稱') !!}
                    {!!Form::select('equipment_name', $equipment['options'], 0, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group col-md-3">
                    {!!Form::label('equipment_num', '借用數量') !!}
                    {!!Form::selectRange('equipment_num', 1, 5, 0, ['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    {!!Form::label('usage', '用途') !!}
                    {!!Form::text('usage', old('usage'), ['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-md-3">
                    {!!Form::label($return_time['name'], $return_time['label']) !!}
                    {!!Form::text('date', '', array('class' => 'form-control','id' => 'datepicker')) !!}
                </div>
                <div class="form-group col-md-3">
                    {!!Form::label('remark', '備註') !!}
                    {!!Form::text('remark', old('remark'), ['class'=>'form-control']) !!}
                </div>
            </div>
            <hr>
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