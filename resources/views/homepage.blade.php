@extends('layouts.master')

@section('title')
    首頁
@endsection

@section('script')
    <script type="text/javascript" src="{{ URL::asset('js/homepage.js') }}"></script>
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
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="black-background px-3 pt-4 pb-2 text-center mh-85 overflow-auto scrollbar">
            <div>
                <h1 class="mx-4 px-5 pb-2 yellow-title border-bottom-white-2px">資管系教室設備借用系統</h1>
            </div>
            <div class="pt-3 d-flex justify-content-center">
                <div>
                    <a href="{{ route('classroom.status') }}" class="text-decoration-none">
                        <h3 class="px-3 py-1 yellow-index">教室預約狀況</h3>
                    </a>
                    <div>
                        <h3 type="button" id="borrow" class="px-3 yellow-index">教室設備借用</h3>
                        <div id="subindex" class="d-none pb-3">
                            <a class="text-decoration-none" href="{{route('application.new')}}">
                                <h5 class="px-2 yellow-subindex">新增申請</h5>
                            </a>
                            <a class="text-decoration-none" href="{{ route('application.list') }}">
                                <h5 class="px-2 yellow-subindex">申請清單</h5>
                            </a>
                            @if (Auth::check())
                                <a class="text-decoration-none" href="{{ route('application.renting_list') }}">
                                    <h5 class="px-2 yellow-subindex">借出中清單</h5>
                                </a>
                                <a class="text-decoration-none" href="{{ route('application.returned_list') }}">
                                    <h5 class="px-2 yellow-subindex">已歸還清單</h5>
                                </a>
                            @endif
                        </div>
                    </div>
                    @if (Auth::check() && Auth::user()->role === '管理員')
                        <div>
                            <h3 type="button" id="appointment" class="px-3 yellow-index">教室預約</h3>
                            <div id="subindex" class="d-none pb-3">
                                <a class="text-decoration-none" href="{{ route('reservation.new') }}">
                                    <h5 class="px-2 yellow-subindex">新增預約</h5>
                                </a>
                                <a class="text-decoration-none" href="{{ route('reservation.list') }}">
                                    <h5 class="px-2 yellow-subindex">預約清單</h5>
                                </a>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('reservation.list') }}" class="text-decoration-none">
                            <h3 class="px-3 py-1 yellow-index">教室預約清單</h3>
                        </a>
                    @endif
                    @if(Auth::check())
                        <div>
                            <h3 type="button" id="equipment" class="px-3 yellow-index">設備管理</h3>
                            <div id="subindex" class="d-none pb-3">
                                <a class="text-decoration-none" href="{{route('equipment.add')}}">
                                    <h5 class="px-2 yellow-subindex">新增設備</h5>
                                </a>
                                <a class="text-decoration-none" href="{{ route('equipment.list') }}">
                                    <h5 class="px-2 yellow-subindex">設備清單</h5>
                                </a>
                                @can('manager')
                                    <a class="text-decoration-none" href="{{ route('equipment.record') }}">
                                        <h5 class="px-2 yellow-subindex">設備借用紀錄</h5>
                                    </a>
                                @endcan
                            </div>
                        </div>
                        <div class="mt-3">
                            <h6 type="button" id="user" class="text-muted">你好， {{ Auth::user()->name }}！<i class="text-muted fas fa-caret-down"></i></h6>
                            <div id="subindex" class="d-none">
                                @can('manager')
                                    <a class="text-decoration-none px-2" href="{{route('user.userlist')}}">
                                        <span class="text-muted">管理使用者</span><br>
                                    </a>
                                @endcan
                                <a class="text-decoration-none px-2" href="{{route('user.changepw')}}">
                                    <span class="text-muted">修改密碼</span><br>
                                </a>
                                <a class="text-decoration-none px-2" href="{{route('user.logout')}}">
                                    <span class="text-muted">登出</span>
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="mt-3">
                            <a class="text-decoration-none" href="{{route('user.signin')}}">
                                <h6 class="text-muted">管理者登入</h6>
                            </a>
                        </div>
                    @endif
                    <div class="mt-3">
                        <p class="text-center text-muted mb-0"><small>Copyright 2020 © 中央資管大數據暨程式設計研究社</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection