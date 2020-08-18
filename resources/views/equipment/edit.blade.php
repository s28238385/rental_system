@extends('layouts.master')

@section('title')
    編輯設備
@endsection

@section('content')
<div class="row d-flex justify-content-center mt-5">
    <div class="col-md-4">
        <h1 class="mb-3 text-info font-weight-normal mt-5 text-center">編輯設備</h1>
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
                <label for="genre">種類<span class="required">*</span></label>
                <input type="text" id="genre" name="genre" class="form-control" placeholder="種類" value="{{ $equipment->genre }}" required>
            </div>
            <div class="form-group">
                <label for="item">項目<span class="required">*</span></label>
                <input type="text" id="item" name="item" class="form-control" placeholder="項目"" value="{{ $equipment->item }}" required>
            </div>
            <div class="form-group">
                <label for="quantity">數量<span class="required">*</span></label>
                <input type="text" id="quantity" name="quantity" class="form-control" placeholder="數量" value="{{ $equipment->quantity }}" required>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-outline-primary px-3">修改</button>
            </div>
        </form>
    </div>
</div>
@endsection