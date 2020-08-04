@extends("layouts.master")

@section("content")

<form action="{{ route('reserve.long') }}" method = "POST"> 
    <div style = "padding:10px 25px;">
        <div class="form-row" style = "padding:5px 15px;">
            <div class="form-group col-md-2">
                <label for="reserveClassroom">借用教室</label>
                <select class="custom-select" id="inlineFormCustomSelect" name="Classroom">
                    <option value="I_314" selected>I_314</option>
                    <option value="I_315">I_315</option>
                    <option value="I1_002">I1_002</option>
                    <option value="I1_017">I1_017</option>
                    <option value="I1_105">I1_105</option>
                    <option value="I1_107">I1_107</option>
                    <option value="I1_223">I1_223</option>
                    <option value="I1_404">I1_404</option>
                    <option value="I1_507_1">I1_507_1</option>
                    <option value="I1_933">I1_933</option>
                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="name">申請人&nbsp&nbsp&nbsp&nbsp</label>
                <input type = "text" class="form-control" id="" name="Name">
            </div>
        </div>
        
        <div class="form-group">
            <div class="form-group col-md-4">
                <label for="reserveReason">申請內容</label>
                <input type = "textarea" class="form-control" data-toggle="tooltip" title="請輸入申請內容" id="" name="Reason">
            </div>
        </div>

        <div class="form-row">
            <div class="form-row" style = "padding:5px 20px;">
                <div class="form-group  col-md-3">
                    <label for="startDate">開始日期</label>
                    <input type = "text" class="form-control" id="from" name="DateStart">
                </div>
            
                <div class="form-group col-md-3">
                    <label for="endDate">結束日期</label>
                    <input type = "text" class="form-control" id="to" name="DateEnd">
                </div>
                
                <div class="form-group col-md-2">
                    <label for="dayOfWeek">借用星期</label>
                    <select class="custom-select" id="inlineFormCustomSelect" name="DOW">
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

            
        </div>


        <div class="form-row" style = "padding:5px 15px;">
            <div class="form-group col-md-2">
                <label for="beginTime">開始時間</label>
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
                <label for="endTime">結束時間</label>
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


@endsection("content")

<!-- Bootstrap js cdn -->
@section('script')

<!--datepicker jquery-->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">

<script type="text/javascript" src="{{ URL::asset('js/reserve.js') }}"></script>

<!--alert-->

<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
</script>
  
@endsection