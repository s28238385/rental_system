@extends('layouts.master')

@section('title')
    編輯設備 | 資管系教室設備借用系統
@endsection

@section('content')
<div class="row d-flex justify-content-center mt-5">
    <div class="col-4">
        <h1 class="mb-3 color-2F91CD font-weight-normal mt-5 text-center">編輯設備</h1>
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                <p class="text-center">{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <form action="{{ route('equipment.edit', ['id' => $equipment->id]) }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">名稱：<span class="required">*</span></label>
                <input type="text" id="name" name="name" class="form-control" placeholder="種類" autocomplete="off" value="<?=$equipment->name?>">
            </div>
            <div class="form-group">
                <label for="index">索引：</label>
                <input type="text" id="index" name="index" class="form-control" placeholder="項目" autocomplete="off" value="<?=$equipment->index?>">
            </div>
            <div class="form-group">
                <label for="quantity">數量：<span class="required">*</span></label>
                <input type="text" id="quantity" name="quantity" class="form-control" placeholder="數量" autocomplete="off" value="<?=$equipment->quantity?>">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-outline-primary px-3">修改</button>
            </div>
        </form>
    </div>
</div>
@endsection