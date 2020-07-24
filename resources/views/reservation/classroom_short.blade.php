@extends("layouts.master")

@section("content")
    
<form  action="{{ route('reserve.short') }}" method = "POST">
    <div style = "padding:10px 25px;">    
        <div class="form-row" style = "padding:5px 15px;">
            <div class="form-group col-md-2">
                <label for="reserveClassroom">借用教室</label>
                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="Classroom">
                    <option value="I_314" selected>I_314</option>
                    <option value="I_315">I_315</option>
                    <option value="I1_002">I1_002</option>
                    <option value="I1_017">I1_017</option>
                    <option value="I1_105">I1_105</option>
                    <option value="I1_107">I1_107</option>
                    <option value="I1_223">I1_223</option>
                    <option value="I1_404">I1_404</option>
                    <option value="I1_507-1">I1_507-1</option>
                    <option value="I1_933">I1_933</option>
                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="name">申請人&nbsp&nbsp&nbsp&nbsp</label>
                <input type = "text" class="form-control" data-toggle="tooltip" title="請輸入姓名" id="" name="Name"></select>
            </div>

            
        </div>
        
        <div class="form-group">
            <div class="form-group col-md-4">
                <label for="reserveReason">申請內容</label>
                <input type = "textarea" class="form-control" data-toggle="tooltip" title="請輸入申請內容" id="" name="Reason"></select>
            </div>
        </div>

        <div class="form-group">
            
            <div class="form-group col-md-4">
                <label for="reserveDate">借用日期</label>
                <input type = "text" class="form-control" id="datepicker" name="Date"></select>
            </div>
        </div>

        <div class="form-row" style = "padding:5px 15px;">
            <div class="form-group col-md-2">
                <label for="beginTime">開始節次</label>
                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="Start">
                    <option value ="08:00:00" selected>08:00</option>
                    <option value="09:00:00">09:00</option>
                    <option value="10:00:00">10:00</option>
                    <option value="11:00:00">11:00</option>
                    <option value="12:00:00">12:00</option>
                    <option value="13:00:00">13:00</option>
                    <option value="14:00:00">14:00</option>
                    <option value="15:00:00">15:00</option>
                    <option value="16:00:00">16:00</option>
                    <option value="17:00:00">17:00</option>
                    <option value="18:00:00">18:00</option>
                    <option value="19:00:00">19:00</option>
                    <option value="20:00:00">20:00</option>
                    <option value="21:00:00">21:00</option>
                    
                </select>
            </div>
        
            <div class="form-group col-md-2">
                <label for="endTime">結束節次</label>
                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="End">
                    <option value="09:00:00" selected>09:00</option>
                    <option value="10:00:00">10:00</option>
                    <option value="11:00:00">11:00</option>
                    <option value="12:00:00">12:00</option>
                    <option value="13:00:00">13:00</option>
                    <option value="14:00:00">14:00</option>
                    <option value="15:00:00">15:00</option>
                    <option value="16:00:00">16:00</option>
                    <option value="17:00:00">17:00</option>
                    <option value="18:00:00">18:00</option>
                    <option value="19:00:00">19:00</option>
                    <option value="20:00:00">20:00</option>
                    <option value="21:00:00">21:00</option>
                    <option value="22:00:00">22:00</option>
                </select>
            </div>
        </div>

        <div style = "padding:5px 15px;">
            <button type="submit" class="btn btn-primary" >確認預約</button>
        </div>
    </div>
    {!! csrf_field() !!}
</form>

<?php
    date_default_timezone_set("Asia/Taipei");
    if ( !empty($_POST["Name"]) && !empty($_POST["Reason"]) && !empty($_POST["Date"])) {
        if($start >= $end){
            echo "<script>alert('開始節次不可以大於結束節次!!');</script>";
        }
    }
    else if(isset($_POST["Name"])){
        echo "<script>alert('申請人不可為空!!');</script>";
    }
    else if(isset($_POST["Reason"])){
        echo "<script>alert('申請內容不可為空!!');</script>";
    }
    else if(isset($_POST["Date"])){
        echo "<script>alert('日期不可為空!!');</script>";
    }
     
?> 

@endsection("content")


<!-- Bootstrap js cdn -->
@section('script')

<!--datepicker jquery-->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">

<!--datepicker range-->
<script>
    $( function() {
        var dateFormat = "mm/dd/yy",
        from = $( "#from" )
            .datepicker({
            defaultDate: "+1w",
            changeMonth: false,
            numberOfMonths: 1
            })
            .on( "change", function() {
            to.datepicker( "option", "minDate", getDate( this ) );
            }),
        to = $( "#to" ).datepicker({
            defaultDate: "+1w",
            changeMonth: false,
            numberOfMonths: 1
        })
        .on( "change", function() {
            from.datepicker( "option", "maxDate", getDate( this ) );
        });

        function getDate( element ) {
        var date;
        try {
            date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
            date = null;
        }

        return date;
        }
    } );
</script>

<!--datepicker-->
<script>
    $( function() {
    $( "#datepicker" ).datepicker();
    } );
</script>

<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>
  
@endsection
