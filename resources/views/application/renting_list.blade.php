@extends('layouts.master')

@section('title')
    借出中清單
@endsection 

@section('content')
    <div class="d-flex inline-flex align-items-center mt-5 mb-3">
        <h1 class="font-weight-normal text-info">借出中清單</h1>
        <a href="{{ route('application.list') }}" type="button" class="btn btn-sm btn-outline-primary ml-3 mr-1">申請清單</a>
        <a href="{{ route('application.returned_list') }}" type="button" class="btn btn-sm btn-outline-primary mx-1">已歸還清單</a>
    </div>
    <div class="d-flex justify-content-center my-2">
        {{ $applications->links() }}
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>申請編號</th>
                <th>申請時間</th>
                <th>申請人</th>
                <th>身分</th>
                @can('manager')
                    <th>手機/分機</th>
                @endcan
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
                    <td colspan="<?php if(Auth::check()){echo 9;}else{echo 8;}?>">無借出中申請</td>
                </tr>
            @else
                @foreach($applications as $application)
                    <tr>
                        <td>{{ $application->id }}</td>
                        <td>{{ $application->created_at }}</td>
                        <td>{{ $application->name }}</td>
                        <td>{{ $application->identity }}</td>
                        @can('manager')
                            <td>{{ $application->phone }}</td>
                        @endcan
                        <td>{{ $application->certificate }}</td>
                        <td>{{ $application->status }}</td>
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
    <div class="d-flex justify-content-center my-2">
        {{ $applications->links() }}
    </div>
@endsection