@extends('layouts.master')

@section('title')
    設備清單 | 資管系設備借用系統
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-outline-primary">新增設備</button>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th id="genre" scope="col">設備種類</th>
                <th id="item" scope="col">設備項目</th>
                <th id="quantity" scope="col">設備數量</th>
                <th id="management" scope="col">設備管理</th>
            </tr>
        </thead>
        <tbody>
            @foreach($equipments as $equipment)
                <tr>
                    <td headers="genre"><?=$equipment['genre'];?></td>
                    <td headers="item"><?=$equipment['item'];?></td>
                    <td headers="quantity"><?=$equipment['quantity'];?></td>
                    <td headers="management">
                        <div id="management-button" class="d-flex justify-content-around">
                            <button type="button" class="btn btn-outline-primary btn-sm">查看</button>
                            <button type="button" class="btn btn-outline-primary btn-sm">編輯</button>
                            <button type="button" class="btn btn-outline-primary btn-sm">刪除</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection