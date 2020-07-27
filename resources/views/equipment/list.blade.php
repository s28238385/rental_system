@extends('layouts.master')

@section('title')
    設備清單 | 資管系設備借用系統
@endsection

@section('content')
@if (Session::has('success'))
    <div class="row justify-content-end m-2 fixed-bottom">
        <div class="hint alert alert-success alert-sm alert-dismissible col fade show text-center" role="alert">
            <p class="m-0 text-wrap">{{ Session::get('success') }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@elseif(Session::has('fail'))
    <div class="row justify-content-end m-2 fixed-bottom">
        <div class="hint alert alert-danger alert-sm alert-dismissible col fade show text-center" role="alert">
            <span class="text-wrap">{{ Session::get('success') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif
<div class="d-flex inline-flex align-items-baseline mt-5 mb-3">
    <h1 class="font-weight-normal color-2F91CD">設備清單</h1>
    <a type="button" class="btn btn-outline-success ml-auto px-3" href="{{ route('equipment.add') }}">新增設備</a>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th id="genre" class="table-cell pl-4" scope="col">名稱</th>
            <th id="item" class="table-cell" scope="col">子分類</th>
            <th id="quantity" class="table-cell" scope="col">數量</th>
            <th id="management" class="teble-cell" scope="col">管理</th>
        </tr>
    </thead>
    <tbody>
        @if($equipments->isEmpty())
            <tr>
                <td colspan="4">無登錄設備</td>
            </tr>
        @else
            @foreach($equipments as $equipment)
                <tr>
                    <td class="pl-4 table-cell"><?=$equipment['genre'];?></td>
                    <td class="teble-cell"><?=$equipment['item'];?></td>
                    <td class="teble-cell"><?=$equipment['quantity'];?></td>
                    <td class="teble-cell">
                        <div id="management-button" class="d-flex justify-content-start">
                            <!--<a href=""><button type="button" class="btn btn-outline-primary btn-sm mr-1">查看</button></a>-->
                            <a href="{{ route('equipment.edit', ['id' => $equipment->id]) }}" type="button" class="btn btn-outline-primary btn-sm px-3 mx-1">編輯</a>
                            <a href="{{ route('equipment.delete', ['id' => $equipment->id]) }}" type="button" class="btn btn-outline-primary btn-sm px-3 mx-1" onclick="return confirm('確定刪除設備?')">刪除</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
@endsection