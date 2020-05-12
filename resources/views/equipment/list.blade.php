@extends('layouts.master')

@section('title')
    設備清單 | 資管系設備借用系統
@endsection

@section('content')
<div class="container mt-5">
    <div>
        <h1>設備清單</h1>
    </div>
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('equipment.add') }}"><button type="button" class="btn btn-outline-primary">新增設備</button></a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th id="genre" scope="col">設備種類</th>
                <th id="item" scope="col">設備項目</th>
                <th id="quantity" scope="col">設備數量</th>
                <th id="management" scope="col" class="w-25">設備管理</th>
            </tr>
        </thead>
        <tbody>
            @if(!$equipments)
                <tr>
                    <td>無現有設備</td>
                </tr>
            @else
                @foreach($equipments as $equipment)
                    <tr>
                        <td headers="genre"><?=$equipment['genre'];?></td>
                        <td headers="item"><?=$equipment['item'];?></td>
                        <td headers="quantity"><?=$equipment['quantity'];?></td>
                        <td headers="management">
                            <div id="management-button" class="d-flex justify-content-start">
                                <!--<a href=""><button type="button" class="btn btn-outline-primary btn-sm mr-1">查看</button></a>-->
                                <a href="{{ route('equipment.edit', ['id' => $equipment->id]) }}"><button type="button" class="btn btn-outline-primary btn-sm mr-1">編輯</button></a>
                                <a href="{{ route('equipment.delete', ['id' => $equipment->id]) }}"><button type="button" class="btn btn-outline-primary btn-sm">刪除</button></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection