@extends('layouts.master')

@section('title')
    長期預約清單
@endsection

@section('content')
    <div class="d-flex inline-flex align-items-center mt-5 mb-3">
        <div class="d-flex align-items-end">
            <h1 class="font-weight-normal text-info mb-0">長期預約清單</h1>
            <p class="ml-2 mb-0">長期預約編號：{{ $reservations[0]['long_term_id'] }}</p>
        </div>
        @can('manager')
            <div class="ml-auto">
                <a href="{{ route('longterm.add', ['id' => $reservations[0]['long_term_id']]) }}" type="button" class="btn btn-sm btn-outline-primary px-3">新增至長期預約</a>
                <a href="{{ route('longterm.delete', ['id' => $reservations[0]['long_term_id']]) }}" type="button" class="btn btn-sm btn-outline-danger px-3" onclick="return confirm('確定刪除長期預約?')">刪除長期預約</a>
            </div>
        @endcan
    </div>
    <table class="table table-hover mt-4">
        <thead>
            <tr>
                <th class="align-middle">編號</th>
                <th class="align-middle">申請人</th>
                @can('manager')
                    <th class="align-middle">連絡電話</th>
                @endcan
                <th class="align-middle">申請原因</th>
                <th class="align-middle">教室</th>
                <th class="align-middle">預約日期</th>
                <th class="align-middle">開始時間</th>
                <th class="align-middle">結束時間</th>
                @can('manager')
                    <th class="align-middle">管理</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td class="align-middle">{{ $reservation['id'] }}</td>
                    <td class="align-middle">{{ $reservation['name'] }}</td>
                    @can('manager')
                        <td class="align-middle">{{ $reservation['phone'] }}</td>
                    @endcan
                    <td class="align-middle text-break">{{ $reservation['reason'] }}</td>
                    <td class="align-middle">{{ $reservation['classroom'] }}</td>
                    <td class="align-middle text-break">{{ $reservation['date'] }}</td>
                    <td class="align-middle">{{ $reservation['begin_time'] }}</td>
                    <td class="align-middle">{{ $reservation['end_time'] }}</td>
                    @can('manager')
                        <td class="align-middle">
                            <a href="{{ route('reservation.edit', ['id' => $reservation['id']]) }}" type="button" class="btn btn-outline-primary btn-sm px-3 m-1">編輯</a>
                            <a href="{{ route('reservation.delete', ['id' => $reservation['id']]) }}" type="button" class="btn btn-outline-danger btn-sm px-3 m-1" onclick="return confirm('確定刪除預約?')">刪除</a>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection