@extends('layouts.master')

@section('title')
資管系教室設備借用系統
@endsection

@section('content')
<div class="homepage vh-100">
    <div class="container vh-100 d-flex justify-content-center">
        <div class="d-flex align-items-center">
            <div class="black-background px-3 pt-4 pb-2">
                <div>
                    <h1 class="px-5 pb-2 yellow-title border-bottom-white-2px">資管系教室設備借用系統</h1>
                </div>
                <div class="pt-3 d-flex justify-content-center">
                    <div>
                        <a href="" class="text-decoration-none"><h3 class="px-3 py-1 yellow-index" href="#">教室預約狀況</h3></a>
                        <h3 type="button"id="borrow" class="px-3 yellow-index" href="#">教室設備借用</h3>
                        <div id="subindex" class="text-center d-none">
                            <a class="text-decoration-none" href="#"><h5 class="px-2 yellow-subindex">新增申請</h5></a>
                            <a class="text-decoration-none" href="#"><h5 class="px-2 yellow-subindex">申請清單</h5></a>
                        </div>
                    </div>
                </div>
                <div class="">
                    <a class="text-decoration-none" href="#"><h6 class="text-center text-muted mt-4">管理者登入</h6></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ URL::asset('js/homepage.js') }}"></script>
@endsection