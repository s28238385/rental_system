@extends('layouts.master')

@section('title')
    預約清單
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
                <span class="text-wrap">{{ Session::get('success') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    <div class="d-flex inline-flex align-items-center mt-5 mb-3">
        <h1 class="font-weight-normal text-info">預約清單</h1>
        <a type="button" class="btn btn-outline-success ml-3 px-3" href="{{ route('reservation.new') }}">新增預約</a>
        <div class="ml-auto">
            {{ $reservations->links() }}
        </div>
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
                            <a href="{{ route('reservation.delete', ['id' => $reservation->id]) }}" type="button" class="btn btn-outline-danger btn-sm px-3 mx-1" onclick="return confirm('確定刪除設備?')">刪除</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection