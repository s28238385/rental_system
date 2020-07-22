<nav class="navbar navbar-expand-lg py-1 px-5">
    <a class="navbar-brand header-button" href="#">資管系教室設備借用系統</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span><i class="fas fa-bars"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link header-button" href="#">教室預約狀況</a>
            </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle header-button" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        教室設備借用
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">新增申請</a>
                        <a class="dropdown-item" href="#">申請清單</a>
                    </div>
                </li>
            @if(Auth::check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle header-button" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        教室預約
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/reservation/classroom_short">單次預約</a>
                        <a class="dropdown-item" href="/reservation/classroom_long">長期預約</a>
                    </div>
                </li>
                @can('manager')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle header-button" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            設備管理
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('equipment.add')}}">新增設備</a>
                            <a class="dropdown-item" href="#">設備清單</a>
                        </div>
                    </li>
                @endcan
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle header-button" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        你好， <?=Auth::user()->name?>！
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