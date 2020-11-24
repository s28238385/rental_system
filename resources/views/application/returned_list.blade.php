@extends('layouts.master')

@section('title')
    已歸還清單
@endsection 

@section('content')
    <div class="d-flex inline-flex align-items-center mt-5 mb-3">
        <h1 class="font-weight-normal text-info">已歸還清單</h1>
        <a href="{{ route('application.list') }}" type="button" class="btn btn-sm btn-outline-primary ml-3 mr-1">申請清單</a>
        <a href="{{ route('application.renting_list') }}" type="button" class="btn btn-sm btn-outline-primary mx-1">借出中清單</a>
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
                <th class="align-middle">詳細資料</th>
            </tr>
        </thead>
        <tbody>
            @if($applications->isEmpty())
                <tr>
                    <td class="align-middle" colspan="{{ (Auth::check())? '8' : '7' }}">無已歸還申請</td>
                </tr>
            @else
                @foreach($applications as $application)
                    <tr>
                        <td class="align-middle">{{ $application->id }}</td>
                        <td class="align-middle text-break">{{ Date('Y-m-d H:i', strtotime($application->created_at)) }}</td>
                        <td class="align-middle">{{ $application->name }}</td>
                        <td class="align-middle">{{ $application->identity }}</td>
                        @can('manager')
                            <td class="align-middle">{{ $application->phone }}</td>
                        @endcan
                        <td class="align-middle">{{ $application->certificate }}</td>
                        <td class="align-middle">{{ $application->status }}</td>
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