@extends('layouts/master')

<!-- status style -->
<link href="{{ URL::to('css/status_style.css') }}" rel="stylesheet" type="text/css">

@section('title')
    教室預約狀況
@endsection

@section('content')
{{-- enter point --}}
{{-- 經 searching 選擇教室後傳來的 chosen_status --}}
<input type="hidden" id="chosen_status" value="#{{ $chosen_status }}" >

<div class="container">
    <div id="classroom-tabs" class="mt-3">
        <ul class="nav nav-tabs nav-justified" id="classroomTab" role="tablist">
            @foreach ($classrooms as $classroom)
            <li class="nav-item">
                <a class="nav-link" id="{{ $classroom->classroomName }}-tab" href="#{{ $classroom->classroomName }}">{{ $classroom->classroomName }}</a>
            </li>
            @endforeach
        </ul>
        @foreach ($classrooms as $classroom)
        <div id="{{ $classroom->classroomName }}">
            <img src="{{ URL::to($classroom->imagePath) }}" class="img-fluid img-thumbnail">
        </div>
        @endforeach 
    </div>

    <!-- include calender -->
    @include('partials/calender')
</div><!-- end cotainer -->

<!-- Modal -->
<div class="modal fade" id="loaderModal" tabindex="-1" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body container-fluid">
                <div class="row justify-content-center p-2">
                    <div class="loader"></div>
                </div>
                <div class="row justify-content-center mt-2">
                    <p class="m-0">資料載入中，請稍候</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  end Modal -->

@endsection<!-- end content -->

@section('script')
{{-- 載入預約資料到calender上 --}}
<script src="{{ URL::asset('js/reservation_for_calender.js') }}" type="text/javascript"></script>
@endsection

