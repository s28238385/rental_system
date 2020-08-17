@extends('layouts.master')

@section('title')
    設備清單
@endsection

@section('script')
    <script>
        let equipments = <?php echo json_encode($records); ?>;
    </script>
    <script src="{{ URL::asset('js/equipment_record.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    @if (Session::has('success'))
        <div class="row justify-content-end m-2 fixed-bottom">
            <div class="hint alert alert-success alert-sm alert-dismissible col fade show text-center" role="alert">
                <p class="m-0 text-wrap">{{ Session::get('success') }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @elseif(Session::has('fail'))
        <div class="row justify-content-end m-2 fixed-bottom">
            <div class="hint alert alert-danger alert-sm alert-dismissible col fade show text-center" role="alert">
                <span class="text-wrap">{{ Session::get('fail') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    <div class="d-flex inline-flex align-items-center mt-5 mb-3">
        <h1 class="font-weight-normal text-info">設備清單</h1>
        <a type="button" class="btn btn-outline-success ml-auto px-3" href="{{ route('equipment.add') }}">新增設備</a>
    </div>
    <div class="d-flex justify-content-center mb-2">
        {{ $equipments->links() }}
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="table-cell pl-4">種類</th>
                <th class="table-cell">項目</th>
                <th class="table-cell">數量</th>
                <th class="teble-cell">管理</th>
            </tr>
        </thead>
        <tbody>
            @if($equipments->isEmpty())
                <tr>
                    <td colspan="4">無登錄設備</td>
                </tr>
            @else
                @foreach($equipments as $equipment)
                    <tr>
                        <td class="pl-4 table-cell">{{ $equipment->genre }}</td>
                        <td class="teble-cell">{{ $equipment->item }}</td>
                        <td class="teble-cell">{{ $equipment->quantity }}</td>
                        <td class="teble-cell">
                            <div id="management-button">
                                <a href="{{ route('equipment.edit', ['id' => $equipment->id]) }}" type="button" class="btn btn-outline-primary btn-sm px-3 mx-1">編輯</a>
                                <a href="{{ route('equipment.delete', ['id' => $equipment->id]) }}" type="button" class="btn btn-outline-danger btn-sm px-3 mx-1 {{ (Auth::user()->role === '管理員')? "" : "disabled" }}" onclick="return confirm('確定刪除設備?')">刪除</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-2">
        {{ $equipments->links() }}
    </div>
@endsection