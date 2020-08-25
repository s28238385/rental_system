@extends('layouts.master')

@section('title')
    設備借用紀錄
@endsection

@section('script')
    <script>
        //將php變數傳至js
        let equipments = <?php echo json_encode($equipments); ?>;
        let oldItem = <?php echo json_encode(old('item')); ?>;
    </script>
    <script src="{{ URL::asset('js/equipment_record.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    <div class="mt-5 mb-3">
        <h1 class="font-weight-normal text-info">設備借用紀錄</h1>
    </div>
    <form action="{{ route('equipment.record') }}" method="get" class="form-inline justify-content-end">
        <div class="form-group">
            <label for="genre" class="mb-0">種類：</label>
            <select name="genre" id="genre" class="form-control-sm">
                <option>請選擇種類</option>
                @foreach ($equipments as $key => $value)
                    <option {{ (old('genre') === $key)? 'selected' : '' }}>{{ $key }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group ml-2">
            <label for="item" class="mb-0">項目：</label>
            <select name="item" id="item" class="form-control-sm">
                <option>請選擇項目</option>
            </select>
        </div>
        <div class="form-group ml-2">
            <button type="submit" class="btn btn-sm btn-outline-primary">查詢</button>
        </div>
    </form>
    <div class="d-flex justify-content-center mb-2">
        {{ $records->links() }}
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>種類</th>
                <th>項目</th>
                <th>數量</th>
                <th>狀態</th>
                <th>申請人</th>
                <th>借出經辦</th>
                <th>歸還經辦</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $record)
                @if(isset($record->classroom))
                    <tr>
                        <td>{{ $record->classroom }}鑰匙</td>
                        <td>{{ $record->key_type }}</td>
                        <td>1</td>
                        <td>{{ $record->status }}</td>
                        <td>{{ $record->name }}</td>
                        <td>{{ $record->rent_by }}</td>
                        <td>{{ $record->return_by }}</td>
                    </tr>
                @elseif (isset($record->genre))
                    <tr>
                        <td>{{ $record->genre }}</td>
                        <td>{{ $record->item }}</td>
                        <td>{{ $record->quantity }}</td>
                        <td>{{ $record->status }}</td>
                        <td>{{ $record->name }}</td>
                        <td>{{ $record->rent_by }}</td>
                        <td>{{ $record->return_by }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-2">
        {{ $records->links() }}
    </div>
@endsection