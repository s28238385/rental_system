@extends('layouts/master')

<link href="{{ URL::to('css/status_style.css') }}" rel="stylesheet" type="text/css">

@section('title')
教室預約狀況
@endsection

{{-- enter point --}}
<input type="hidden" id="chosen_status" value="#{{ $chosen_status }}" >

@section('content')
<div class="container">
    {{-- leave blank --}}
    <div class="leave_blank"></div>
    
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

    @include('partials/calender')
        @yield('calender')
</div>
@endsection

<!-- Bootstrap js cdn -->
@section('script')


<script type="text/javascript">
  $(document).ready(function(){
    //enter point
    var chosen_status = $('#chosen_status').val();
    //console.log(chosen_status);//test
    $('.nav-tabs a[href="'+chosen_status+'"]').tab('show');


    $('.nav-tabs a').click(function(){
      //console.log('click');//test
      $(this).tab('show');
    });
  });
</script>
@endsection