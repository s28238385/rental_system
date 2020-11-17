@extends('layouts.master')

@section('title')
請使用校內IP以新增借用申請
@endsection

@section('script')
    <script type="text/javascript" src="{{ URL::asset('js/homepage.js') }}"></script>
@endsection

@section('content')
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="black-background px-3 pt-4 pb-2 text-center mh-85 overflow-auto scrollbar">
            <div>
                <h1 class="mx-4 px-5 pb-2 yellow-title border-bottom-white-2px">資管系教室設備借用系統</h1>
            </div>
            <div class="pt-3">
                <h3 class="yellow-title">請使用校內IP以新增借用申請</h3>
                <div class="mt-3">
                    <p class="text-center text-muted mb-0"><small>Copyright 2020 © 中央資管大數據暨程式設計研究社</small></p>
                </div>
            </div>
        </div>
    </div>
@endsection