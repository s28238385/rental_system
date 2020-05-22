@extends('layouts.master')


@section('title')
    編輯設備 | 資管系教室設備借用系統
@endsection

@section('content')
<div class="container mt-5">
    <div>
        <h1>編輯設備</h1>
    </div>
    <form action="{{ route('equipment.edit', ['id' => $equipment->id]) }}" method="post">
        <div class="form-group">
            <label for="genre">設備種類：<br></label>
            <input type="text" id="genre" name="genre" value=<?=$equipment->genre;?>>
        </div>
        <div class="form-group">
            <label for="item">設備項目：<br></label>
            <input type="text" id="item" name="item" value=<?=$equipment->item;?>>
        </div>
        <div class="form-group">
            <label for="quantity">設備數量：<br></label>
            <input type="text" id="quantity" name="quantity" value=<?=$equipment->quantity;?>>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        {{ csrf_field() }}
    </form>
</div>
@endsection('content')