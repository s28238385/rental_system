@extends('layouts/master')

<!-- status style -->
<link href="{{ URL::to('css/status_style.css') }}" rel="stylesheet" type="text/css">

{{-- 使手機版可正常顯示 --}}
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

{{-- for ajax post method --}}
{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

@section('title')
教室預約狀況
@endsection

{{-- enter point --}}
{{-- 經 searching 選擇教室後傳來的 chosen_status --}}
<input type="hidden" id="chosen_status" value="#{{ $chosen_status }}" >

@section('content')
{{-- cover style.css --}}
<style>
#classroomTab .nav-link{
  color: #aaa;
}
#classroomTab .active{
  color: #000;
}
</style>

<div class="container">
    {{-- user_explain --}}
    <div class="user_explain">
      <div>預約教室前，請先在此頁面查尋可借用時間再預約。</div>
      <br/>
      @if (Auth::check())
        <div style="margin-bottom: 1rem">
          <a href="{{route('reserve.short')}}" class="btn btn-outline-primary" type="button">單次預約</a>&nbsp僅借用教室一天時使用。
        </div>
        <div>
          <a href="{{route('reserve.long')}}" class="btn btn-outline-primary" type="button">長期預約</a>&nbsp借用教室大於一天時使用，如一般上課。
        </div>
      @else
        預約功能僅限管理員操作，如欲預約請先登入。
      @endif
      
    </div>
    
    <ul class="nav nav-tabs nav-justified" id="classroomTab" role="tablist">
        @foreach ($classrooms as $classroom)
          <li class="nav-item">
            {{-- <a class="nav-link" id="{{ $classroom->classroomName }}-tab" data-toggle="tab" href="#{{ $classroom->classroomName }}" role="tab" aria-controls="{{ $classroom->classroomName }}" aria-selected="true">{{ $classroom->classroomName }}</a> --}}
            <a class="nav-link" id="{{ $classroom->classroomName }}-tab" href="#{{ $classroom->classroomName }}">{{ $classroom->classroomName }}</a>
          </li>
        @endforeach
    </ul>

    <div class="tab-content" id="classroomTabContent">
        @foreach ($classrooms as $classroom)
          <div class="tab-pane fade" id="{{ $classroom->classroomName }}" role="tabpanel">
            <img src="{{ URL::to($classroom->imagePath) }}" class="img-fluid img-thumbnail">
          </div>
        @endforeach 
    </div>

    {{-- get reservation test button --}}
    {{-- <button type="button" class="show_res">ajax test </button> --}}
    <button type="button" data-toggle="modal" data-target="#loaderModal" class="">loader test </button>

    <!-- include calender -->
    @include('partials/calender')

</div><!-- end cotainer -->

<!-- Modal -->
<div class="modal fade" id="loaderModal" tabindex="-1" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
          <div class="modal-body container-fluid">
            <div class="row justify-content-center" style="padding: 5%">
              <div class="loader" ></div>
            </div>
            <div class="row justify-content-center" style="margin-top: 5%">
              資料載入中，請稍候
            </div>
          </div>
      </div>
  </div>
</div>
<!--  end Modal -->

@endsection<!-- end content -->

@section('script')
<script type="text/javascript">
  $(document).ready(function(){
    //enter point
    var chosen_status = $('#chosen_status').val();
    //console.log(chosen_status); //test
    $('.nav-tabs a[href="'+chosen_status+'"]').tab('show');

      $('.nav-tabs a').click(function(){
        //console.log('click');//test
        $(this).tab('show');
      });
    });
</script>
{{-- 載入預約資料到calender上 --}}
<script src="{{ URL::asset('js/reservation_for_calender.js') }}" type="text/javascript"></script>
@endsection

