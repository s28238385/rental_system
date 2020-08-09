@extends ('layouts.master')

@section('title')
    編輯申請
@endsection

@section('script')
<script>
    //把php變數傳入js
    let application = <?php echo json_encode($application); ?>;
    let rent_equipments = <?php echo json_encode($rent_equipments); ?>;
    let equipments = <?php echo json_encode($equipments); ?>;
</script>
<script src="{{ URL::asset('js/application_edit.js') }}" type="text/javascript"></script>
@endsection

@section('content')
<div class="pt-3">
    {{-- 顯示錯誤訊息 --}}
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p class="text-center">{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <form action="{{ route('application.edit', ['application_id'=> $application->id]) }}" method="post">
        {{ csrf_field() }}
        <div id="formSection">
            <div class="card p-4">
                <h2 class="text-primary">基本資料</h2>
                <div class="form-row pt-3 d-flex align-items-end">
                    <div class="form-group col-md-4">
                        <label for="name">姓名<span class="required">*</span></label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $application->name }}" placeholder="姓名" autocomplete="off" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="identity">身分</label>
                        <select class="form-control" name="identity" id="identity">
                            <option selected>學生</option>
                            <option>教職員</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4" id="gradePart">
                        <label for="grade">系級<span class="required">*</span></label>
                        <input name='grade' id="grade" class="form-control" value="{{ $application->identity }}" placeholder="必填" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="phone"><span class="text">手機</span><span class="required">*</span></label>
                        <input type="text" class="form-control" name="phone" id="phone" value="{{ $application->phone }}" placeholder="必填" autocomplete="off" required>
                    </div>
                    <div class="form-group col-md-4" id="cardPart">
                        <div class="row m-0">
                            <div class="col-md-12 px-1">
                                <label for="certificate">抵押證件</label>
                                <select class="form-control" name="certificate" id="certificate">
                                    <option selected>學生證</option>
                                    <option>身分證</option>
                                    <option>健保卡</option>
                                    <option>駕照</option>
                                    <option>其他</option>
                                </select>
                            </div>
                            <div class="col-md-7 px-1 d-none">
                                <input type="text" class="form-control" name="certificateOther" id="certificateOther" placeholder="請填入要抵押的證件">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="return_time">歸還時間</label>
                        <input type="text" class="form-control" name="return_time" id="return_time" value="{{ $application->return_time }}">
                    </div>
                </div>
            </div>
            <div class="card p-4 mt-3">
                <div class="d-flex inline-flex align-items-center">
                    <h2 class="text-primary mb-0">借用教室</h2>
                    <div class="form-check pt-1 mx-3">
                        <input class="form-check-input" type="checkbox" value="checked" id="wantRentChk" name="wantRentChk">
                        <label class="form-check-label" for="wantRentChk">借用教室</label>
                    </div>
                </div>
                <div id="classroomSection" class="form-row d-none pt-3">
                    <div class="form-group col-md-3" id="classroomPart">
                        <label for="classroom">選擇教室</label>
                        <select name="classroom" id="classroom" class="form-control">
                            @foreach($classroomNames as $classroomName)
                                <option value="{{ $classroomName }}">{{ $classroomName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="key_type">鑰匙種類</label>
                        <select class="form-control" name="key_type" id="key_type">
                            <option selected>服務學習鑰匙</option>
                            <option>備份鑰匙</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="teacher">授課教師</label>
                        <input type="text" class="form-control" name="teacher" id="teacher" value="{{ $application->teacher }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="key-status">鑰匙狀態</label>
                        <select type="text" class="form-control" name="key_status" id="key-status">
                            <option {{ ($application->key_status === '申請中')? "selected" : "" }}>申請中</option>
                            <option {{ ($application->key_status === '借出中')? "selected" : "" }}>借出中</option>
                            <option {{ ($application->key_status === '已歸還')? "selected" : "" }}>已歸還</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card p-4 mt-3">
                <h2 class="text-primary mb-0">借用設備</h2>
                <div class="equipmentContainer">
                    {{-- use js to insert equipment template --}}
                </div>
                <div class="form-group m-0">
                    <button type="button" class="btn btn-success px-3 mt-3" id="moreBtn" name="moreBtn">借用更多設備</button>
                </div>
            </div>
            <div class="card border-0 my-3">
                <button type="submit" class="btn btn-warning disabled">送出</button>
            </div>
        </div>
    </form>
</div>
{{-- equipment template --}}
<div id="equipmentTemplate" class="d-none">
    <div class="d-inline-flex py-3 align-items-center">
        <h4 id="equipmentNum" class="text-info mr-3">No.1</h4>
        <button type="button" class="btn btn-danger btn-sm px-3" id="dltBtn">刪除</button>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="genre">設備種類</label>
            <select name="genre[]" id="genre" class="form-control"></select>
        </div>
        <div class="form-group col-md-4">
            <label for="item">項目<span class="required">*</span></label>
            <select name="item[]" id="item" class="form-control"></select>
        </div>
        <div class="form-group col-md-4">
            <label for="quantity">數量</label>
            <select name="quantity[]" id="quantity" class="form-control"></select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="usage">用途<span class="required">*</span></label>
            <input type="text" class="form-control" name="usage[]" id="usage" placeholder="必填" required>
        </div>
        <div class="form-group col-md-4">
            <label for="remark">備註</label>
            <input type="text" class="form-control" name="remark[]" id="remark">
        </div>
        <div class="form-group col-md-4">
            <label for="status">狀態</label>
            <select name="status[]" id="status" class="form-control">
                <option>申請中</option>
                <option>借出中</option>
                <option>已歸還</option>
            </select>
        </div>
    </div>
</div>
@endsection