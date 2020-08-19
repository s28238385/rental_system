@extends('layouts/master')

@section('title')
    教室預約狀況
@endsection

@section('script')
    <script>
        //bring php variables to js
        let token = '{{ Session::token() }}';
        let url = '{{ route('status.ajax') }}';
        let firstDay = '{{ Session::get('first_day') }}';
        let classroom = '{{ Session::get('classroom') }}';
    </script>
    <script src="{{ URL::asset('js/classroom_status.js') }}" type="text/javascript"></script>
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
    {{-- 選擇中的頁籤超連結 --}}
    <input type="hidden" id="chosen_status" value="#All">

    <div id="classroom-tabs" class="mt-3">
        <ul class="nav nav-tabs nav-justified bg-spary" id="classroomTab" role="tablist">
            <li class="nav-item">
                <a href="#All" id="#All-tab" class="nav-link">總覽</a>
            </li>
            @foreach ($classrooms as $classroom)
                <li class="nav-item">
                    <a class="nav-link" id="{{ $classroom->classroomName }}-tab" href="#{{ $classroom->classroomName }}">{{ $classroom->classroomName }}</a>
                </li>
            @endforeach
        </ul>
        <div id="All"></div>
        @foreach ($classrooms as $classroom)
            <div id="{{ $classroom->classroomName }}">
                <div class="row">
                    <div class="col-lg-8 px-1 mt-1">
                        <img src="{{ URL::to($classroom->imagePath) }}" class="img-fluid img-thumbnail p-0 border-0">
                    </div>
                    <div class="col-lg-4 px-1 mt-1">
                        <div class="border-secondary rounded bg-grey d-flex flex-column h-100 p-3">
                            <div class="row m-0 my-auto">
                                <p class="mb-0">{!! nl2br(e($classroom->equipmentDescription), false) !!}</p>
                            </div>
                            @if (Auth::check())
                                @can('manager')
                                    <div class="row m-0 mt-auto d-flex justify-content-end">
                                        <a href="{{ route('reservation.new') }}" type="button" class="btn btn-outline-success">新增預約</a>
                                    </div>
                                @endcan
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach 
    </div>

    {{-- include calender --}}
    @include('partials/calender')
@endsection