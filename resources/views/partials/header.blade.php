<nav id="header" class="navbar navbar-expand-lg py-1 px-5">
    <a class="navbar-brand header-button" href="/">資管系教室設備借用系統</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span><i class="fas fa-bars"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link header-button" href="{{route('classroom.status')}}">教室預約狀況</a>
            </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle header-button" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        教室設備借用
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('application.new') }}">新增申請</a>
                        <a class="dropdown-item" href="{{ route('application.list') }}">申請清單</a>
                        @if (Auth::check())
                            <a class="dropdown-item" href="{{ route('application.renting_list') }}">借出中清單</a>
                            <a class="dropdown-item" href="{{ route('application.returned_list') }}">已歸還清單</a>
                        @endif
                    </div>
                </li>
            @if(Auth::check())
                @can('manager')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle header-button" href="{{ route('classroom.status') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            教室預約
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a href="{{ route('reservation.new') }}" class="dropdown-item">新增預約</a>
                            <a class="dropdown-item" href="{{ route('reservation.list') }}">預約清單</a>
                        </div>
                    </li>
                @endcan
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle header-button" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        設備管理
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('equipment.add') }}">新增設備</a>
                        <a class="dropdown-item" href="{{ route('equipment.list') }}">設備清單</a>
                        @can('manager')
                            <a class="dropdown-item" href="{{ route('equipment.record') }}">設備借用紀錄</a>
                        @endcan
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle header-button" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        你好， {{ Auth::user()->name }}！
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('manager')
                            <a class="dropdown-item" href="{{route('user.userlist')}}">管理使用者</a>
                        @endcan
                        <a class="dropdown-item" href="{{route('user.changepw')}}">修改密碼</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('user.logout')}}">登出</a>
                    </div>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link header-button" href="{{route('user.signin')}}">管理者登入</a>
                </li>
            @endif
        </ul>
    </div>
</nav>