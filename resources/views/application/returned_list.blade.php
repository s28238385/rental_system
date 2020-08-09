@extends('layouts.master')

@section('title')
    已歸還清單
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
        <h1 class="font-weight-normal text-info">已歸還清單</h1>
        <a href="{{ route('application.list') }}" type="button" class="btn btn-sm btn-outline-primary ml-3 mr-1">申請清單</a>
        <a href="{{ route('application.renting_list') }}" type="button" class="btn btn-sm btn-outline-primary mx-1">借出中申請</a>
        <div class="ml-auto">
            {{ $applications->links() }}
        </div>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>申請編號</th>
                <th>申請時間</th>
                <th>申請人</th>
                <th>身分</th>
                <th>手機/分機</th>
                <th>證件</th>
                <th>狀態</th>
                @if (Auth::check())
                    <th>借出/歸還</th>
                @endif
                <th>詳細資料</th>
            </tr>
        </thead>
        <tbody>
            @if($applications->isEmpty())
                <tr>
                    <td colspan="<?php if(Auth::check()){echo 9;}else{echo 8;}?>">無已歸還申請</td>
                </tr>
            @else
                @foreach($applications as $application)
                    <tr>
                        <td>{{ $application->id }}</td>
                        <td>{{ $application->created_at }}</td>
                        <td>{{ $application->name }}</td>
                        <td>{{ $application->identity }}</td>
                        <td>{{ $application->phone }}</td>
                        <td>{{ $application->certificate }}</td>
                        <td>{{ $application->all_status }}</td>
                        @if (Auth::check())
                            <td>
                                <a type="button" href="{{ route('application.rent', ['application_id' => $application->id]) }}" class="btn btn-sm btn-outline-success px-3">借出</a>
                                <a type="button" href="{{ route('application.return', ['application_id' => $application->id]) }}" class="btn btn-sm btn-outline-success px-3">歸還</a>
                            </td>
                        @endif
                        <td>
                            <a href="{{ route('application.information', ['application_id' => $application->id]) }}" type="button" class="btn btn-sm btn-outline-primary">詳細資料</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection