@extends('layouts.master')

@section('title')
    編輯教室預約
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-8 mt-3">
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p class="text-center">{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <div class="card p-4">
                <h1 class="text-primary mb-4">編輯教室預約</h1>
                <form action="{{ route('reservation.edit', ['id' => $reservation->id]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">申請人<span class="required">*</span></label>
                            <input type="text" id="name" class="form-control" name="name" placeholder="必填" value="{{ $reservation->name }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="reason">申請原因<sapn class="required">*</sapn></label>
                            <input type="text" id="name" class="form-control" name="reason" placeholder="必填" value="{{ $reservation->reason }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="classroom">借用教室</label>
                            <select class="form-control" id="classroom" name="classroom">
                                <option value="I_314" {{ ($reservation->classroom === 'I_314')? "selected" : "" }}>I_314</option>
                                <option value="I_315" {{ ($reservation->classroom === 'I_315')? "selected" : "" }}>I_315</option>
                                <option value="I1_002" {{ ($reservation->classroom === 'I1_002')? "selected" : "" }}>I1_002</option>
                                <option value="I1_017" {{ ($reservation->classroom === 'I1_017')? "selected" : "" }}>I1_017</option>
                                <option value="I1_105" {{ ($reservation->classroom === 'I1_105')? "selected" : "" }}>I1_105</option>
                                <option value="I1_107" {{ ($reservation->classroom === 'I1_107')? "selected" : "" }}>I1_107</option>
                                <option value="I1_223" {{ ($reservation->classroom === 'I1_223')? "selected" : "" }}>I1_223</option>
                                <option value="I1_404" {{ ($reservation->classroom === 'I1_404')? "selected" : "" }}>I1_404</option>
                                <option value="I1_507_1" {{ ($reservation->classroom === 'I1_507_1')? "selected" : "" }}>I1_507_1</option>
                                <option value="I1_933" {{ ($reservation->classroom === 'I1_933')? "selected" : "" }}>I1_933</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="begin-date">借用日期</label>
                            <input type="date" id="begin-date" class="form-control" name="begin_date" value="{{ $reservation->date }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="begin-time">開始時間</label>
                                <select class="form-control" id="begin-time" name="begin_time">
                                    <option value="1" {{ ($reservation->begin_time === "1")? "selected" : "" }}>08:00</option>
                                    <option value="2" {{ ($reservation->begin_time === "2")? "selected" : "" }}>09:00</option>
                                    <option value="3" {{ ($reservation->begin_time === "3")? "selected" : "" }}>10:00</option>
                                    <option value="4" {{ ($reservation->begin_time === "4")? "selected" : "" }}>11:00</option>
                                    <option value="Z" {{ ($reservation->begin_time === "Z")? "selected" : "" }}>12:00</option>
                                    <option value="5" {{ ($reservation->begin_time === "5")? "selected" : "" }}>13:00</option>
                                    <option value="6" {{ ($reservation->begin_time === "6")? "selected" : "" }}>14:00</option>
                                    <option value="7" {{ ($reservation->begin_time === "7")? "selected" : "" }}>15:00</option>
                                    <option value="8" {{ ($reservation->begin_time === "8")? "selected" : "" }}>16:00</option>
                                    <option value="9" {{ ($reservation->begin_time === "9")? "selected" : "" }}>17:00</option>
                                    <option value="A" {{ ($reservation->begin_time === "A")? "selected" : "" }}>18:00</option>
                                    <option value="B" {{ ($reservation->begin_time === "B")? "selected" : "" }}>19:00</option>
                                    <option value="C" {{ ($reservation->begin_time === "C")? "selected" : "" }}>20:00</option>
                                    <option value="D" {{ ($reservation->begin_time === "D")? "selected" : "" }}>21:00</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end-time">結束時間</label>
                                <select class="form-control" id="end-time" name="end_time">
                                    <option value="1" {{ ($reservation->end_time === "1")? "selected" : "" }}>09:00</option>
                                    <option value="2" {{ ($reservation->end_time === "2")? "selected" : "" }}>10:00</option>
                                    <option value="3" {{ ($reservation->end_time === "3")? "selected" : "" }}>11:00</option>
                                    <option value="4" {{ ($reservation->end_time === "4")? "selected" : "" }}>12:00</option>
                                    <option value="Z" {{ ($reservation->end_time === "Z")? "selected" : "" }}>13:00</option>
                                    <option value="5" {{ ($reservation->end_time === "5")? "selected" : "" }}>14:00</option>
                                    <option value="6" {{ ($reservation->end_time === "6")? "selected" : "" }}>15:00</option>
                                    <option value="7" {{ ($reservation->end_time === "7")? "selected" : "" }}>16:00</option>
                                    <option value="8" {{ ($reservation->end_time === "8")? "selected" : "" }}>17:00</option>
                                    <option value="9" {{ ($reservation->end_time === "9")? "selected" : "" }}>18:00</option>
                                    <option value="A" {{ ($reservation->end_time === "A")? "selected" : "" }}>19:00</option>
                                    <option value="B" {{ ($reservation->end_time === "B")? "selected" : "" }}>20:00</option>
                                    <option value="C" {{ ($reservation->end_time === "C")? "selected" : "" }}>21:00</option>
                                    <option value="D" {{ ($reservation->end_time === "D")? "selected" : "" }}>22:00</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <button type="submit" class="btn btn-success px-3 col-md-12">修改預約</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection