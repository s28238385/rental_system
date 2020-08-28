@extends('layouts.master')

@section('title')
    借用清單
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
    <div class="d-flex inline-flex align-items-center mt-5 mb-3">
        <h1 class="font-weight-normal text-info">申請清單</h1>
        @if (Auth::check())
            <a href="{{ route('application.renting_list') }}" type="button" class="btn btn-sm btn-outline-primary ml-4 mr-1">借出中清單</a>
            <a href="{{ route('application.returned_list') }}" type="button" class="btn btn-sm btn-outline-primary mx-1">已歸還清單</a>
        @endif
        <a type="button" class="btn btn-outline-success ml-auto px-3" href="{{ route('application.new') }}">新增申請</a>
    </div>
    <div class="d-flex justify-content-center my-2">
        {{ $applications->links() }}
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="align-middle">申請編號</th>
                <th class="align-middle">申請時間</th>
                <th class="align-middle">申請人</th>
                <th class="align-middle">身分</th>
                @can('manager')
                    <th class="align-middle">手機/分機</th>
                @endcan
                <th class="align-middle">證件</th>
                <th class="align-middle">狀態</th>
                @if (Auth::check())
                    <th class="align-middle">借出/歸還</th>
                @endif
                <th class="align-middle">詳細資料</th>
            </tr>
        </thead>
        <tbody>
            @if($applications->isEmpty())
                <tr>
                    <td class="align-middle" colspan="{{ (Auth::check())? '9' : '8' }}">無登錄申請</td>
                </tr>
            @else
                @foreach($applications as $application)
                    <tr>
                        <td class="align-middle">{{ $application->id }}</td>
                        <td class="align-middle text-break">{{ $application->created_at }}</td>
                        <td class="align-middle">{{ $application->name }}</td>
                        <td class="align-middle">{{ $application->identity }}</td>
                        @can('manager')
                            <td class="align-middle">{{ $application->phone }}</td>
                        @endcan
                        <td class="align-middle">{{ $application->certificate }}</td>
                        <td class="align-middle">{{ $application->status }}</td>
                        @if (Auth::check())
                            <td class="align-middle py-1">
                                <a type="button" href="{{ route('application.rent', ['application_id' => $application->id]) }}" class="btn btn-sm btn-outline-success px-3 my-1">借出</a>
                                <a type="button" href="{{ route('application.return', ['application_id' => $application->id]) }}" class="btn btn-sm btn-outline-success px-3 my-1">歸還</a>
                            </td>
                        @endif
                        <td class="align-middle">
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