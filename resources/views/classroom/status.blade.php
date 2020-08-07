@extends('layouts/master')

@section('title')
    教室預約狀況
@endsection

@section('script')
    <script>
        //bring php variables to js
        let token = '{{ Session::token() }}';
        let url = '{{ route('status.ajax') }}'
    </script>

    {{-- 載入預約資料到calender上 --}}
    <script src="{{ URL::asset('js/reservation_for_calender.js') }}" type="text/javascript"></script>
@endsection

@section('content')
{{-- enter point --}}
<input type="hidden" id="chosen_status" value="#All">

<div class="container">
    <div id="classroom-tabs" class="mt-3">
        <ul class="nav nav-tabs nav-justified" id="classroomTab" role="tablist">
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
            <div id="{{ $classroom->classroomName }}" class="row">
                <div class="col-lg-7 px-1 mt-1">
                    <img src="{{ URL::to($classroom->imagePath) }}" class="img-fluid img-thumbnail p-0 border-0">
                </div>
                <div class="col-lg-5 px-1 mt-1">
                    <div class="border-secondary rounded bg-grey h-100 d-flex align-items-center py-2 px-3">
                        <p class="mb-0">{!! nl2br(e($classroom->equipmentDescription), false) !!}</p>
                    </div>
                </div>
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