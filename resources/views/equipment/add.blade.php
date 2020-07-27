@extends('layouts.master')

@section('title')
    新增設備 | 資管系教室設備借用系統
@endsection

@section('content')
<div class="row d-flex justify-content-center mt-5">
    <div class="col-4">
        <h1 class="mb-3 color-2F91CD font-weight-normal mt-5 text-center">新增設備</h1>
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                <p class="text-center">{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <form action="{{ route('equipment.add') }}" method="post">
            <div class="form-group">
                <label for="genre">名稱：<span class="required">*</span></label>
                <input type="text" id="genre" name="genre" class="form-control" placeholder="種類" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="item">子分類：</label>
                <input type="text" id="item" name="item" class="form-control" placeholder="項目" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="quantity">數量：<span class="required">*</span></label>
                <input type="text" id="quantity" name="quantity" class="form-control" placeholder="數量" autocomplete="off">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-outline-primary px-3">新增</button>
            </div>
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection('content')