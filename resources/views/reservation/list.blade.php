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
        @can('manager')
            <a type="button" class="btn btn-outline-success ml-auto px-3" href="{{ route('reservation.new') }}">新增預約</a>
        @endcan
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
                @foreach ($classroomNames as $classroomName)
                    <option value="{{ $classroomName }}" {{ (old('classroom') === $classroomName)? "selected" : "" }}>{{ $classroomName }}</option>
                @endforeach
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
            <button type="submit" class="btn btn-sm btn-outline-primary px-3 m-1">查詢</button>
            <button id="reset" class="btn btn-sm btn-outline-danger m-1">清除</button>
        </div>
    </form>
    <div class="d-flex justify-content-center my-2">
        {{ $reservations->links() }}
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="align-middle">編號</th>
                <th class="align-middle">申請人</th>
                @can('manager')
                    <th class="align-middle">聯絡電話</th>
                @endcan
                <th class="align-middle">申請原因</th>
                <th class="align-middle">教室</th>
                <th class="align-middle">預約日期</th>
                <th class="align-middle">開始時間</th>
                <th class="align-middle">結束時間</th>
                <th class="align-middle">長期預約</th>
                @can('manager')
                    <th class="align-middle">管理</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @if($reservations->isEmpty())
                <tr>
                    <td class="align-middle" colspan="{{ (Auth::check() && Auth::user()->role === '管理員')? '10' : '8' }}">無登錄預約</td>
                </tr>
            @else
                @foreach($reservations as $reservation)
                    <tr>
                        <td class="align-middle">{{ $reservation->id }}</td>
                        <td class="text-break align-middle">{{ $reservation->name }}</td>
                        @can('manager')
                            <td class="align-middle">{{ $reservation->phone }}</td>
                        @endcan
                        <td class="text-break align-middle">{{ $reservation->reason }}</td>
                        <td class="align-middle">{{ $reservation->classroom }}</td>
                        <td class="text-break align-middle">{{ $reservation->date }}</td>
                        <td class="align-middle">{{ $reservation->begin_time }}</td>
                        <td class="align-middle">{{ $reservation->end_time }}</td>
                        <td class="align-middle">
                            @if(!empty($reservation->long_term_id))
                                <a type="button" href="{{ route('reservation.longterm', ['long_term_id' => $reservation->long_term_id]) }}" class="btn btn-sm btn-outline-primary px-3">查看</a>
                            @endif
                        </td>
                        @can('manager')
                            <td class="align-middle px-1">
                                <a href="{{ route('reservation.edit', ['id' => $reservation->id]) }}" type="button" class="btn btn-outline-primary btn-sm px-3 mx-1 my-1">編輯</a>
                                <a href="{{ route('reservation.delete', ['id' => $reservation->id]) }}" type="button" class="btn btn-outline-danger btn-sm px-3 mx-1 my-1" onclick="return confirm('確定刪除預約?')">刪除</a>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center my-2">
        {{ $reservations->links() }}
    </div>
@endsection