@extends('layouts.master')

@section('title')
    預約清單
@endsection

@section('script')
    <script src="{{ URL::asset('js/reservation_search.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    {{-- 系統訊息顯示 --}}
    @if ( Session::has('success') )
        <div class="row justify-content-end m-2 fixed-bottom">
            <div class="hint alert alert-success alert-sm alert-dismissible col fade show text-center" role="alert">
                <p class="m-0 text-wrap">{{ Session::get('success') }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @elseif( Session::has('fail') )
        <div class="row justify-content-end m-2 fixed-bottom">
            <div class="hint alert alert-danger alert-sm alert-dismissible col fade show text-center" role="alert">
                <span class="text-wrap">{{ Session::get('fail') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    <div class="d-flex inline-flex align-items-center mt-5 mb-3">
        <h1 class="font-weight-normal text-info">預約清單</h1>
        <a type="button" class="btn btn-outline-success ml-auto px-3" href="{{ route('reservation.new') }}">新增預約</a>
    </div>
    <form action="{{ route('reservation.list') }}" method="get" class="form-inline justify-content-end my-2">
        <div class="form-group mx-1 my-1">
            <label for="name" class="mb-0">申請人：</label>
            <input type="text" name="name" id="name" class="form-control-sm" value="{{ old('name') }}">
        </div>
        <div class="form-group mx-1 my-1">
            <label for="reason" class="mb-0">申請原因：</label>
            <input type="text" name="reason" id="reason" class="form-control-sm" value="{{ old('reason') }}">
        </div>
        <div class="form-group mx-1 my-1">
            <label for="classroom" class="m-0">教室：</label>
            <select name="classroom" id="classroom" class="form-control-sm">
                <option>請選擇教室</option>
                <option {{ (old('classroom') === 'I_314')? "selected" : "" }}>I_314</option>
                <option {{ (old('classroom') === 'I_315')? "selected" : "" }}>I_315</option>
                <option {{ (old('classroom') === 'I1_002')? "selected" : "" }}>I1_002</option>
                <option {{ (old('classroom') === 'I1_017')? "selected" : "" }}>I1_017</option>
                <option {{ (old('classroom') === 'I1_105')? "selected" : "" }}>I1_105</option>
                <option {{ (old('classroom') === 'I1_107')? "selected" : "" }}>I1_107</option>
                <option {{ (old('classroom') === 'I1_223')? "selected" : "" }}>I1_223</option>
                <option {{ (old('classroom') === 'I1_404')? "selected" : "" }}>I1_404</option>
                <option {{ (old('classroom') === 'I1_507_1')? "selected" : "" }}>I1_507_1</option>
                <option {{ (old('classroom') === 'I1_933')? "selected" : "" }}>I1_933</option>
            </select>
        </div>
        <div class="form-group mx-1 my-1">
            <label for="date" class="m-0">日期：</label>
            <input type="date" name="begin_date" id="date" class="form-control-sm" value="{{ old('begin_date') }}" max="9999-12-31">
            <p class="mb-0 mx-1">~</p>
            <input type="date" name="end_date" id="date" class="form-control-sm" value="{{ old('end_date') }}" max="9999-12-31">
        </div>
        <div class="form-group ml-2 my-1">
            <label for="loop-day" class="m-0">星期：</label>
            <div id="loop-day" class="d-flex inline-flex align-items-center">
                <div class="d-flex inline-flex align-items-center mx-1">
                    <input type="checkbox" name="loop_day[]" id="sunday" value="Sun" {{ (!is_null(old('loop_day')) && in_array("Sun", old('loop_day')))? 'checked' : '' }}>
                    <label for="sunday">星期日</label>
                </div>
                <div class="d-flex inline-flex align-items-center mx-1">
                    <input type="checkbox" name="loop_day[]" id="monday" value="Mon" {{ (!is_null(old('loop_day')) && in_array("Mon", old('loop_day')))? 'checked' : '' }}>
                    <label for="monday">星期一</label>
                </div>
                <div class="d-flex inline-flex align-items-center mx-1">
                    <input type="checkbox" name="loop_day[]" id="tuesday" value="Tue" {{ (!is_null(old('loop_day')) && in_array("Tue", old('loop_day')))? 'checked' : '' }}>
                    <label for="tuesday">星期二</label>
                </div>
                <div class="d-flex inline-flex align-items-center mx-1">
                    <input type="checkbox" name="loop_day[]" id="wednesday" value="Wed" {{ (!is_null(old('loop_day')) && in_array("Wed", old('loop_day')))? 'checked' : '' }}>
                    <label for="wednesday">星期三</label>
                </div>
                <div class="d-flex inline-flex align-items-center mx-1">
                    <input type="checkbox" name="loop_day[]" id="thursday" value="Thu" {{ (!is_null(old('loop_day')) && in_array("Thu", old('loop_day')))? 'checked' : '' }}>
                    <label for="thursday">星期四</label>
                </div>
                <div class="d-flex inline-flex align-items-center mx-1">
                    <input type="checkbox" name="loop_day[]" id="friday" value="Fri" {{ (!is_null(old('loop_day')) && in_array("Fri", old('loop_day')))? 'checked' : '' }}>
                    <label for="friday">星期五</label>
                </div>
                <div class="d-flex inline-flex align-items-center mx-1">
                    <input type="checkbox" name="loop_day[]" id="saturday" value="Sat" {{ (!is_null(old('loop_day')) && in_array("Sat", old('loop_day')))? 'checked' : '' }}>
                    <label for="saturday">星期六</label>
                </div>
            </div>
        </div>
        <div class="form-group ml-2 my-1">
            <button type="submit" class="btn btn-sm btn-outline-primary px-3">查詢</button>
        </div>
    </form>
    <div class="d-flex justify-content-center my-2">
        {{ $reservations->links() }}
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>編號</th>
                <th>申請人</th>
                <th>申請原因</th>
                <th>教室</th>
                <th>預約日期</th>
                <th>開始時間</th>
                <th>結束時間</th>
                <th>長期預約</th>
                <th>管理</th>
            </tr>
        </thead>
        <tbody>
            @if($reservations->isEmpty())
                <tr>
                    <td colspan="<?php if(Auth::check()){echo 9;}else{echo 8;}?>">無登錄預約</td>
                </tr>
            @else
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->name }}</td>
                        <td class="text-break">{{ $reservation->reason }}</td>
                        <td>{{ $reservation->classroom }}</td>
                        <td>{{ $reservation->date }}</td>
                        <td>{{ $reservation->begin_time }}</td>
                        <td>{{ $reservation->end_time }}</td>
                        <td>
                            @if(!empty($reservation->long_term_id))
                                <a type="button" href="{{ route('reservation.longterm', ['long_term_id' => $reservation->long_term_id]) }}" class="btn btn-sm btn-outline-primary">查看同期預約</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('reservation.edit', ['id' => $reservation->id]) }}" type="button" class="btn btn-outline-primary btn-sm px-3 mx-1">編輯</a>
                            <a href="{{ route('reservation.delete', ['id' => $reservation->id]) }}" type="button" class="btn btn-outline-danger btn-sm px-3 mx-1" onclick="return confirm('確定刪除預約?')">刪除</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center my-2">
        {{ $reservations->links() }}
    </div>
@endsection