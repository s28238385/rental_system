@extends('layouts/master')

<!-- status style -->
<link href="{{ URL::to('css/status_style.css') }}" rel="stylesheet" type="text/css">

{{-- 使手機板可正常顯示 --}}
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

{{-- for ajax post method --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

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
      如要借用教室，請先查尋可借用時間再點選
      <button class="btn btn-outline-primary" type="button">預約</button>
      按鈕
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

    {{-- ajax test button --}}
    <button type="button" class="show_res">ajax test </button>

    <!-- include calender -->
    @include('partials/calender')
        @yield('calender')
</div>

  {{-- <!-- Bootstrap js cdn -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}

  {{-- 此段 script 經測試似乎無法放置於 @section('script') --}}
  {{-- 推測原因是和calender衝突 --}}
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
@endsection<!-- end content -->

