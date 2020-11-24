@extends('layouts.master')

@section('title')
    申請資訊
@endsection

@section('content')
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
    <div class="my-3">
        <div class="card p-4">
            <div class="d-flex align-items-end">
                <h2 class="text-primary mb-0">基本資料</h2>
                @if(Auth::check())
                    <div class="ml-auto mr-3">
                        <a type="button" href="{{ route('application.rent', ['application_id' => $application->id]) }}" class="btn btn-outline-success px-3 mx-1 {{ ($application->status == '申請中')? '' : 'disabled' }}">借出</a>
                        <a type="button" href="{{ route('application.return', ['application_id' => $application->id]) }}" class="btn btn-outline-success px-3 mx-1 {{ ($application->status != '已歸還')? '' : 'disabled' }}">歸還</a>
                        <a type="button" href="{{ route('application.edit', ['application_id' => $application->id]) }}" class="btn btn-outline-primary px-3 mx-1">編輯</a>
                        @can('manager')
                            <a type="button" href="{{ route('application.delete', ['application_id' => $application->id]) }}" class="btn btn-outline-danger px-3 mx-1" onclick="return confirm('確定刪除這筆申請？')">刪除</a>
                        @endcan
                    </div>
                @endif
            </div>
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-md-6">
                        <p>申請編號：{{ $application->id }}</p>
                    </div>
                    <div class="col-md-6">
                        <p>申請狀態：{{ $application->status }}</p>
                    </div>
                    <div class="col-md-6">
                        <p>申請時間：{{ Date('Y-m-d H:i', strtotime($application->created_at)) }}</p>
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
                    @if (Auth::check())
                        <div class="col-md-6">
                            <p>手機/分機：{{ $application->phone }}</p>
                        </div>
                    @endif
                    @if (!is_null($application->certificate))
                        <div class="col-md-6">
                            <p>抵押證件：{{ $application->certificate }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @if (!is_null($rent_key))
            <div class="card p-4 mt-3">
                <div class="d-flex inline-flex align-items-center">
                    <h2 class="text-primary">借用教室</h2>
                    @if (Auth::check() && $rent_key->status === '申請中')
                        <a href="{{ route('rentkey.delete', ['application_id' => $application->id]) }}" class="btn btn-sm btn-outline-danger ml-auto px-3" onclick="return confirm('確定刪除教室借用？')">刪除</a>
                    @endif
                </div>
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-md-3">
                            <p>借用教室：{{ $rent_key->classroom }}</p>
                        </div>
                        <div class="col-md-3">
                            <p>鑰匙種類：{{ $rent_key->key_type }}</p>
                        </div>
                        <div class="col-md-6">
                            <p>歸還時間：{{ ($rent_key->status != '已歸還')? Date('Y-m-d', strtotime($rent_key->return_time)) : Date('Y-m-d H:i', strtotime($rent_key->return_time)) }}</p>
                        </div>
                        <div class="col-md-3">
                            <p>授課教師：{{ $rent_key->teacher }}</p>
                        </div>
                        <div class="col-md-3">
                            <p>用途：{{ $rent_key->usage }}</p>
                        </div>
                        <div class="col-md-3">
                            <p>備註：{{ $rent_key->remark }}</p>
                        </div>
                        <div class="col-md-3">
                            <p>狀態：{{ $rent_key->status }}</p>
                        </div>
                        @if (Auth::check())
                            <div class="col-md-3">
                                <p>借出經辦：{{ ($rent_key->status != '申請中')? $rent_key->rent_by : '' }}</p>
                            </div>
                            <div class="col-md-3">
                                <p>歸還經辦：{{ $rent_key->return_by }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
        @if (!$rent_equipments->isEmpty())
            <div class="card p-4 mt-3">
                <h2 class="text-primary">借用設備</h2>
                <div class="card-body pb-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td class="align-middle">種類</td>
                                <td class="align-middle">項目</td>
                                <td class="align-middle">數量</td>
                                <td class="align-middle">用途</td>
                                <td class="align-middle">備註</td>
                                <td class="align-middle">歸還時間</td>
                                <td class="align-middle">狀態</td>
                                @if(Auth::check())
                                    <td class="align-middle">借出經辦</td>
                                    <td class="align-middle">歸還經辦</td>
                                    <td class="align-middle">刪除</td>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rent_equipments as $rent_equipment)
                                <tr class="align-middle">
                                    <td class="align-middle">{{ $rent_equipment->genre }}</td>
                                    <td class="align-middle text-break">{{ $rent_equipment->item }}</td>
                                    <td class="align-middle">{{ $rent_equipment->quantity }}</td>
                                    <td class="align-middle text-break">{{ $rent_equipment->usage }}</td>
                                    <td class="align-middle text-break">{{ $rent_equipment->remark }}</td>
                                    <td class="align-middle text-break">{{ ($rent_equipment->status != '已歸還')? Date('Y-m-d', strtotime($rent_equipment->return_time)) : Date('Y-m-d H:i', strtotime($rent_equipment->return_time)) }}</td>
                                    <td class="align-middle">{{ $rent_equipment->status }}</td>
                                    @if (Auth::check())
                                        <td class="align-middle">{{ ($rent_equipment->status != '申請中')?$rent_equipment->rent_by : '' }}</td>
                                        <td class="align-middle">{{ ($rent_equipment->status == '已歸還')?$rent_equipment->return_by : '' }}</td>
                                        <td class="align-middle">
                                            <a href="{{ route('rentequipment.delete', ['rent_equipment_id' => $rent_equipment->id]) }}" type="button" class="btn btn-sm btn-outline-danger ml-auto px-3 {{ ($rent_equipment->status != '申請中')? 'disabled' : '' }}" onclick="return confirm('確定刪除這筆設備借用？')">刪除</a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection