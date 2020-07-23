@extends('layouts.master')

@section('title')
資管系教室設備借用系統
@endsection

@section('content')


<div class="homepage vh-100">
    <div class="container vh-100 d-flex justify-content-center">
        <div class="d-flex align-items-center">
            <div class="black-background px-3 pt-4 pb-2 text-center mh-85 overflow-auto scrollbar">
                <div>
                    <h1 class="mx-4 px-5 pb-2 yellow-title border-bottom-white-2px">資管系教室設備借用系統</h1>
                </div>
                <div class="pt-3 d-flex justify-content-center">
                    <div>
                        <<<<<<< HEAD <a href="" class="text-decoration-none">
                            <h3 class="px-3 py-1 yellow-index" href="#">教室預約狀況</h3>
                            </a>
                            =======
                            <a href="" class="text-decoration-none">
                                <h3 class="px-3 py-1 yellow-index" href="{{route('classroom.getList')}}">教室預約狀況</h3>
                            </a>
                            >>>>>>> cbaab1d970c9b9e3015ec0d31c3d3c7d66d1c897
                            <div>
                                <h3 type="button" id="borrow" class="px-3 yellow-index" href="#">教室設備借用</h3>
                                <div id="subindex" class="d-none pb-3">
                                    <a class="text-decoration-none" href="{{route('newapply.create')}}">
                                        <h5 class="px-2 yellow-subindex">新增申請</h5>
                                    </a>
                                    <a class="text-decoration-none" href="#">
                                        <h5 class="px-2 yellow-subindex">申請清單</h5>
                                    </a>
                                </div>
                            </div>
                            @if(Auth::check())
                            <div>
                                <h3 type="button" id="appointment" class="px-3 yellow-index" href="#">教室預約</h3>
                                <div id="subindex" class="d-none pb-3">
                                    <a class="text-decoration-none" href="">
                                        <h5 class="px-2 yellow-subindex">單次預約</h5>
                                    </a>
                                    <a class="text-decoration-none" href="">
                                        <h5 class="px-2 yellow-subindex">長期預約</h5>
                                    </a>
                                </div>
                            </div>
                            @can('manager')
                            <div>
                                <h3 type="button" id="equipment" class="px-3 yellow-index" href="#">設備管理</h3>
                                <div id="subindex" class="d-none pb-3">
                                    <a class="text-decoration-none" href="{{route('equipment.add')}}">
                                        <h5 class="px-2 yellow-subindex">新增設備</h5>
                                    </a>
                                    <a class="text-decoration-none" href="#">
                                        <h5 class="px-2 yellow-subindex">設備清單</h5>
                                    </a>
                                </div>
                            </div>
                            @endcan
                            @endif
                    </div>
                </div>
                @if(Auth::check())
                <div class=" mt-4 d-flex inline-flex justify-content-center">
                    @can('manager')
                    <a class="text-decoration-none px-1" href="{{route('user.userlist')}}">
                        <h6 class="text-muted">管理使用者</h6>
                    </a>
                    @endcan
                    <a class="text-decoration-none px-1" href="{{route('user.changepw')}}">
                        <h6 class="text-muted">修改密碼</h6>
                    </a>
                    <a class="text-decoration-none px-1" href="{{route('user.logout')}}">
                        <h6 class="text-muted">登出</h6>
                    </a>
                </div>
                @else
                <div class="mt-4">
                    <a class="text-decoration-none" href="{{route('user.signin')}}">
                        <h6 class="text-muted">管理者登入</h6>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<?php 
if(isset($alert)){
    echo $alert;
}
?>

@endsection

@section('script')
<script type="text/javascript" src="{{ URL::asset('js/homepage.js') }}"></script>
@endsection