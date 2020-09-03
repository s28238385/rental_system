@extends('layouts.master')

@section('title')
    編輯設備
@endsection

@section('script')
    <script src="{{ URL::asset('js/equipment_add_or_edit.js') }}" type="text/javascript"></script>
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
                <select name="genre" id="genre" class="form-control">
                    @foreach ($genres as $genre)
                        <option {{ (old('genre') === $genre)? 'selected' : (($equipment->genre === $genre)? 'selected' : '') }}>{{ $genre }}</option>
                    @endforeach
                    <option {{ (old('genre') === '新增設備種類')? 'selected' : '' }}>新增設備種類</option>
                </select>
                <input type="text" id="genreOther" name="genreOther" class="form-control my-1 d-none" value="{{ old('genreOther') }}">
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