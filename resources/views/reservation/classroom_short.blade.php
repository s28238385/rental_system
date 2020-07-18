@extends("layouts.master")

@section("content")
    
<form  action="{{ route('reserve.short') }}" method = "POST">
    <div style = "padding:10px 25px;">    
        <div class="form-row" style = "padding:5px 15px;">
            <div class="form-group col-md-2">
                <label for="reserveClassroom">借用教室</label>
                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="Classroom">
                    <option value="I-314" selected>I-314</option>
                    <option value="I-315">I-315</option>
                    <option value="I1-002">I1-002</option>
                    <option value="I1-017">I1-017</option>
                    <option value="I1-105">I1-105</option>
                    <option value="I1-107">I1-107</option>
                    <option value="I1-223">I1-223</option>
                    <option value="I1-404">I1-404</option>
                    <option value="I1-507-1">I1-507-1</option>
                    <option value="I1-933">I1-933</option>
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
                    
                </select>
            </div>
        
            <div class="form-group col-md-2">
                <label for="endTime">結束節次</label>
                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="End">
                    <option value ="08:50:00" selected>08:50</option>
                    <option value="09:50:00">09:50</option>
                    <option value="10:50:00">10:50</option>
                    <option value="11:50:00">11:50</option>
                    <option value="12:50:00">12:50</option>
                    <option value="13:50:00">13:50</option>
                    <option value="14:50:00">14:50</option>
                    <option value="15:50:00">15:50</option>
                    <option value="16:50:00">16:50</option>
                    <option value="17:50:00">17:50</option>
                    <option value="18:50:00">18:50</option>
                    <option value="19:50:00">19:50</option>
                    <option value="20:50:00">20:50</option>
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