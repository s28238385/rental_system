<!-- searching style -->
<link href="{{ URL::to('css/searching_style.css') }}" rel="stylesheet" type="text/css">

{{-- 使手機版可正常顯示 --}}
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

@extends('layouts/master')

@section('title')
教室預約狀況
@endsection

@section('content')
<div class="row">
    @foreach ($classrooms as $classroom)
        <div class="col-lg-4 p-1">
            <div class="card rounded-0 mx-0 w-auto my-2">
                <div class="image-container p-0">
                    <img src="{{ URL::to($classroom->imagePath) }}" class="card-img-top rounded-0">
                </div>
                <div class="card-body d-flex inline-flex justify-contents-center px-1 mx-1">
                    <h4 class="card-title">{{ $classroom->classroomName }}</h4>
                        <div class="ml-auto">
                            <!-- reserve status -->
                            {{-- 用 chosen_status 傳給 status 以判斷進入點 --}}
                            <form action="{{ route('classroom.status') }}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="chosen_status" value="{{ $classroom->classroomName }}" >
                                <button type="submit" class="btn btn-outline-primary">預約狀況</button>
                            </form>

                            <!-- Button trigger modal -->
                            {{-- use data-mytitle, data-myimgpath, data-mydescription to pass data --}}
                            <button type="button" data-toggle="modal" data-target="#detailModal" class="btn btn-outline-success view_data"
                                data-mytitle="{{ $classroom->classroomName }}"
                                data-myimgpath="{{ URL::to($classroom->imagePath) }}"
                                data-mydescription="{{ $classroom->equipmentDescription }}">
                                設備描述
                            </button>
                        </div>
                </div><!-- end card body -->
                <!-- end card -->  
            </div>
        </div>
    @endforeach

    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="title" class="modal-title"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-md-11 image-container">
                            <img id="classroomImage" src="https://placehold.it/278x132.png" class="img-fluid img-thumbnail">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <textarea id="description" class="col-md-10 form-control" rows="7" style="resize:none;" readonly></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end Modal -->
</div>
@endsection<!-- end content -->

@section('script')
<script>
 $(document).ready(function(){
        //load detail
        $('#detailModal').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var title = button.data('mytitle');
            var imagePath = button.data('myimgpath');
            var description = button.data('mydescription');
            var modal = $(this);

            modal.find('.modal-header #title').text(title);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #classroomImage').attr("src", imagePath);
        });
    });
</script>
@endsection