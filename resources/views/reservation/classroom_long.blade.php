@extends("layouts.master")

@section("content")

<form method = "POST"> 

    <div class="form-row align-items-center" style = "padding:10px 25px;">
        <label for="exampleInputEmail1">借用教室</label>
        <div class="col-auto my-1">
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
    </div>

    <div class="form-row align-items-center" style = "padding:10px 25px;">
        <label for="exampleInputEmail1">開始日期</label>
        <div class="col-auto my-1">
            <input type = "text" class="form-control mr-sm-2" id="from" name="DateStart"></select>
        </div>
    </div>

    <div class="form-row align-items-center" style = "padding:10px 25px;">
        <label for="exampleInputEmail1">結束日期</label>
        <div class="col-auto my-1">
            <input type = "text" class="form-control mr-sm-2" id="to" name="DateEnd"></select>
        </div>
    </div>

    <div class="form-row align-items-center" style = "padding:10px 25px;">
        <label for="exampleInputEmail1">借用星期</label>
        <div class="col-auto my-1">
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="DOW">
                <option value ="一" selected>一</option>
                <option value="二">二</option>
                <option value="三">三</option>
                <option value="四">四</option>
                <option value="五">五</option>
                <option value="六">六</option>
                <option value="日">日</option>
            </select>
        </div>
    </div>

    <div class="form-row align-items-center" style = "padding:10px 25px;">
        <label for="exampleInputEmail1">開始節次</label>
        <div class="col-auto my-1">
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
    </div>

    <div class="form-row align-items-center" style = "padding:10px 25px;">
        <label for="exampleInputEmail1">結束節次</label>
        <div class="col-auto my-1">
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

    <div style = "padding:15px 20px;">
        <button type="submit" class="btn btn-primary" >確認預約</button>
    </div>
    {!! csrf_field() !!}
</form>

<?php
    date_default_timezone_set("Asia/Taipei");
    if ( isset($_POST["Classroom"]) ) {
        $today = date("Y-m-d h:i:s");
        $preDateStart = $_POST["DateStart"];
        $array_date_start = explode("/",$preDateStart);
        $date_start = $array_date_start[2]."-".$array_date_start[0]."-".$array_date_start[1];

        $preDateEnd = $_POST["DateEnd"];
        $array_date_end = explode("/",$preDateEnd);
        $date_end = $array_date_end[2]."-".$array_date_end[0]."-".$array_date_end[1];

        $dow = $_POST["DOW"];
        $classroom = $_POST["Classroom"];
        $start = $_POST["Start"];
        $end = $_POST["End"];

        if($start >= $end){
            echo "<script>alert('開始節次不可以大於結束節次!!');</script>";
        }
        else{
            DB::insert('insert into longterm (教室,開始日期,結束日期,星期,開始節次,結束節次,登記時間) values (?, ?, ?, ?, ?, ?, ?)', [$classroom,$date_start,$date_end,$dow,$start,$end,$today]);
        }
        

     }
     
?> 

@endsection("content")