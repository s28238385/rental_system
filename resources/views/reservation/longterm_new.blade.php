@extends('layouts.master')

@section('title')
    新增教室預約
@endsection

@section('script')
    <script src="{{ URL::asset('js/reservation.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-8 mt-3">
            @if(count($errors) > 0 | Session::has('error'))
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p class="text-center">{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <div class="card p-4">
                <div class="d-flex inline-flex align-items-end">
                    <h1 class="text-primary mb-0">新增教室預約</h1>
                    <p class="mb-0 ml-auto mr-3">長期預約編號：{{ $reservation->long_term_id }}</p>
                </div>
                <form action="{{ route('reservation.new') }}" method="post" class="mt-4">
                    {{ csrf_field() }}
                    <input type="hidden" name="long_term_id" value="{{ $reservation->long_term_id }}">
                    <div class="form-row">
                        <div class="form-group d-flex inline-flex">
                            <div>
                                <input type="radio" name="reservation_type" id="short-term" value="short_term" checked>
                                <label for="short-term">短期借用</label>
                            </div>
                            <div class="ml-2">
                                <input type="radio" name="reservation_type" id="long-term" value="long_term">
                                <label for="long-term">長期借用</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">申請人</label>
                            <input type="text" id="name" class="form-control" name="name" placeholder="必填" value="{{ $reservation->name }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone"">連絡電話</label>
                            <input type="text" id="phone" class="form-control" name="phone" value="{{ $reservation->phone }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="reason">申請原因</label>
                            <input type="text" id="name" class="form-control" name="reason" placeholder="必填" value="{{ $reservation->reason }}" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="classroom">借用教室</label>
                            <input type="text" id="classroom" class="form-control" name="classroom" value="{{ $reservation->classroom }}" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="begin-date">借用日期</label>
                            <input type="date" id="begin-date" class="form-control" name="begin_date" value="{{ old('begin_date') }}" max="9999-12-31" required>
                        </div>
                        <div class="form-group col-md-6 d-none">
                            <label for="end-date">結束日期</label>
                            <input type="date" name="end_date" id="end-date" class="form-control" max="9999-12-31">
                        </div>
                    </div>
                    <div class="form-row d-none">
                        <div class="form-group col-md-12">
                            <label for="loop-day">重複時間</label>
                            <div id="loop-day" class="d-flex justify-content-between">
                                <div>
                                    <input type="checkbox" name="loop_day[]" id="sunday" value="sunday">
                                    <label for="sunday">星期日</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="loop_day[]" id="monday" value="monday">
                                    <label for="monday">星期一</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="loop_day[]" id="tuesday" value="tuesday">
                                    <label for="tuesday">星期二</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="loop_day[]" id="wednesday" value="wednesday">
                                    <label for="wednesday">星期三</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="loop_day[]" id="thursday" value="thursday">
                                    <label for="thursday">星期四</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="loop_day[]" id="friday" value="friday">
                                    <label for="friday">星期五</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="loop_day[]" id="saturday" value="saturday">
                                    <label for="saturday">星期六</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="begin-time">開始時間</label>
                                <select class="form-control" id="begin-time" name="begin_time">
                                    <option value="1" {{ (old('begin_time') === "1")? "selected" : "" }}>08:00</option>
                                    <option value="2" {{ (old('begin_time') === "2")? "selected" : "" }}>09:00</option>
                                    <option value="3" {{ (old('begin_time') === "3")? "selected" : "" }}>10:00</option>
                                    <option value="4" {{ (old('begin_time') === "4")? "selected" : "" }}>11:00</option>
                                    <option value="Z" {{ (old('begin_time') === "Z")? "selected" : "" }}>12:00</option>
                                    <option value="5" {{ (old('begin_time') === "5")? "selected" : "" }}>13:00</option>
                                    <option value="6" {{ (old('begin_time') === "6")? "selected" : "" }}>14:00</option>
                                    <option value="7" {{ (old('begin_time') === "7")? "selected" : "" }}>15:00</option>
                                    <option value="8" {{ (old('begin_time') === "8")? "selected" : "" }}>16:00</option>
                                    <option value="9" {{ (old('begin_time') === "9")? "selected" : "" }}>17:00</option>
                                    <option value="A" {{ (old('begin_time') === "A")? "selected" : "" }}>18:00</option>
                                    <option value="B" {{ (old('begin_time') === "B")? "selected" : "" }}>19:00</option>
                                    <option value="C" {{ (old('begin_time') === "C")? "selected" : "" }}>20:00</option>
                                    <option value="D" {{ (old('begin_time') === "D")? "selected" : "" }}>21:00</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end-time">結束時間</label>
                                <select class="form-control" id="end-time" name="end_time">
                                    <option value="1" {{ (old('end_time') === "1")? "selected" : "" }}>09:00</option>
                                    <option value="2" {{ (old('end_time') === "2")? "selected" : "" }}>10:00</option>
                                    <option value="3" {{ (old('end_time') === "3")? "selected" : "" }}>11:00</option>
                                    <option value="4" {{ (old('end_time') === "4")? "selected" : "" }}>12:00</option>
                                    <option value="Z" {{ (old('end_time') === "Z")? "selected" : "" }}>13:00</option>
                                    <option value="5" {{ (old('end_time') === "5")? "selected" : "" }}>14:00</option>
                                    <option value="6" {{ (old('end_time') === "6")? "selected" : "" }}>15:00</option>
                                    <option value="7" {{ (old('end_time') === "7")? "selected" : "" }}>16:00</option>
                                    <option value="8" {{ (old('end_time') === "8")? "selected" : "" }}>17:00</option>
                                    <option value="9" {{ (old('end_time') === "9")? "selected" : "" }}>18:00</option>
                                    <option value="A" {{ (old('end_time') === "A")? "selected" : "" }}>19:00</option>
                                    <option value="B" {{ (old('end_time') === "B")? "selected" : "" }}>20:00</option>
                                    <option value="C" {{ (old('end_time') === "C")? "selected" : "" }}>21:00</option>
                                    <option value="D" {{ (old('end_time') === "D")? "selected" : "" }}>22:00</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <button type="submit" class="btn btn-success px-3 col-md-12">確定預約</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection