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
        <div class="ml-auto">
            <a href="{{ route('longterm.add', ['id' => $reservations[0]['long_term_id']]) }}" type="button" class="btn btn-sm btn-outline-primary px-3">新增至長期預約</a>
            <a href="{{ route('longterm.delete', ['id' => $reservations[0]['long_term_id']]) }}" type="button" class="btn btn-sm btn-outline-danger px-3" onclick="return confirm('確定刪除長期預約?')">刪除長期預約</a>
        </div>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>編號</th>
                <th>申請人</th>
                <th>申請原因</th>
                <th>教室</th>
                <th>預約日期</th>
                <th>開始時間</th>
                <th>結束時間</th>
                <th>管理</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation['id'] }}</td>
                    <td>{{ $reservation['name'] }}</td>
                    <td class="text-break">{{ $reservation['reason'] }}</td>
                    <td>{{ $reservation['classroom'] }}</td>
                    <td>{{ $reservation['date'] }}</td>
                    <td>{{ $reservation['begin_time'] }}</td>
                    <td>{{ $reservation['end_time'] }}</td>
                    <td>
                        <a href="{{ route('reservation.edit', ['id' => $reservation['id']]) }}" type="button" class="btn btn-outline-primary btn-sm px-3 mx-1">編輯</a>
                        <a href="{{ route('reservation.delete', ['id' => $reservation['id']]) }}" type="button" class="btn btn-outline-danger btn-sm px-3 mx-1" onclick="return confirm('確定刪除預約?')">刪除</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection