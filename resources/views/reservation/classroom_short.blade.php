@extends("layouts.master")

@section("content")
    
<form method = "POST">
    <div class="form-row align-items-center" style = "padding:10px 25px;">
        <label for="exampleInputEmail1">借用日期</label>
        <div class="col-auto my-1">
            <input type = "text" class="form-control mr-sm-2" id="datepicker" name="datepicker"></select>
        </div>
    </div>

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
        <label for="exampleInputEmail1">借用日期</label>
        <div class="col-auto my-1">
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="Month">
                <option value="01" selected>一月</option>
                <option value="02">二月</option>
                <option value="03">三月</option>
                <option value="04">四月</option>
                <option value="05">五月</option>
                <option value="06">六月</option>
                <option value="07">七月</option>
                <option value="08">八月</option>
                <option value="09">九月</option>
                <option value="10">十月</option>
                <option value="11">十一月</option>
                <option value="12">十二月</option>
            </select>
        </div>
        <div class="col-auto my-1">
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="Day">
                <option value="01" selected>01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
                

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
        $year = date("Y");
        $day = $_POST["Day"];
        $month = $_POST["Month"];
        if($month<date("m") || ($month==date("m") && $day<date("d"))){
            $year++;
        }
        $date = $year."-".$month."-".$day;
        $classroom = $_POST["Classroom"];
        $start = $_POST["Start"];
        $end = $_POST["End"];
        DB::insert('insert into shortterm (教室,日期,開始節次,結束節次,登記時間) values (?, ?, ?, ?, ?)', [$classroom,$date,$start,$end,$today]);

     }
     
?> 

@endsection("content")