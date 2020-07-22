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
            <!--@--><!--if(Auth::check())-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle header-button" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    教室預約
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/reservation/classroom_short">單次預約</a>
                        <a class="dropdown-item" href="/reservation/classroom_long">長期預約</a>
                    </div>
                </li>
            <!--@--><!--endif-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle header-button" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    設備管理
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">新增設備</a>
                        <a class="dropdown-item" href="#">設備清單</a>
                    </div>
                </li>
            <!--@--><!--if(Auth::check())-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle header-button" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    管理員
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">管理使用者</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">登出</a>
                    </div>
                </li>
            <!--@--><!--else-->
                <li class="nav-item">
                    <a class="nav-link header-button" href="#">管理者登入</a>
                </li>
            <!--@-><!--endif-->
        </ul>
    </div>
</nav>