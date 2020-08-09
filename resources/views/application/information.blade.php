@extends('layouts.master')

@section('title')
    申請資訊
@endsection

@section('content')
<div class="my-3">
    <div class="card p-4">
        <div class="d-flex align-items-end">
            <h2 class="text-primary mb-0">基本資料</h2>
            @if(Auth::check())
                <div class="ml-auto mr-3">
                    <a type="button" href="{{ route('application.rent', ['application_id' => $application->id]) }}" class="btn btn-outline-success px-3 mx-1">借出</a>
                    <a type="button" href="{{ route('application.return', ['application_id' => $application->id]) }}" class="btn btn-outline-success px-3 mx-1">歸還</a>
                    <a type="button" href="{{ route('application.edit', ['application_id' => $application->id]) }}" class="btn btn-outline-primary px-3 mx-1">編輯</a>
                    <a type="button" href="{{ route('application.delete', ['application_id' => $application->id]) }}" class="btn btn-outline-danger px-3 mx-1" onclick="return confirm('確定刪除這筆申請？')">刪除</a>
                </div>
            @endif
        </div>
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-md-6">
                    <p>申請編號：{{ $application->id }}</p>
                </div>
                <div class="col-md-6">
                    <p>申請狀態：{{ $application->all_status }}</p>
                </div>
                <div class="col-md-6">
                    <p>申請時間：{{ $application->created_at }}</p>
                </div>
                <div class="col-md-6">
                    <p>歸還時間：{{ $application->return_time }}</p>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            <div class="row">
                <div class="col-md-6">
                    <p>姓名：{{ $application->name }}</p>
                </div>
                <div class="col-md-6">
                    <p>身分：{{ $application->identity }}</p>
                </div>
                <div class="col-md-6">
                    <p>手機/分機：{{ $application->phone }}</p>
                </div>
                @if (!is_null($application->certificate))
                    <div class="col-md-6">
                        <p>抵押證件：{{ $application->certificate }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @if (!is_null($application->classroom))
        <div class="card p-4 mt-3">
            <h2 class="text-primary">借用教室</h2>
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-md-3">
                        <p>借用教室：{{ $application->classroom }}</p>
                    </div>
                    <div class="col-md-3">
                        <p>鑰匙種類：{{ $application->key_type }}</p>
                    </div>
                    <div class="col-md-3">
                        <p>授課教師：{{ $application->teacher }}</p>
                    </div>
                    <div class="col-md-3">
                        <p>狀態：{{ $application->key_status }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (!empty($rent_equipments))
        <div class="card p-4 mt-3">
            <h2 class="text-primary">借用設備</h2>
            <div class="card-body pb-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>種類</td>
                            <td>項目</td>
                            <td>數量</td>
                            <td>用途</td>
                            <td>備註</td>
                            <td>狀態</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rent_equipments as $rent_equipment)
                            <tr>
                                <td>{{ $rent_equipment['genre'] }}</td>
                                <td>{{ $rent_equipment['item'] }}</td>
                                <td>{{ $rent_equipment['quantity'] }}</td>
                                <td class="text-break">{{ $rent_equipment['usage'] }}</td>
                                <td class="text-break">{{ $rent_equipment['remark'] }}</td>
                                <td>{{ $rent_equipment['status'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection