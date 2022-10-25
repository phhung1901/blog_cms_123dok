<div class="header">
    <div class="menu_header">
        <a href="#">Mua nhà</a>
        <a href="#">Thuê nhà</a>
        <a href="#">Khám phá</a>
        <a href="#">Blog</a>
    </div>
    <div class="menu_header_respon">
        <img src="/asset/images/Menu.png" alt="">
        <img src="/asset/images/logo_res.png" alt="">
    </div>
    <div class="logo_header">
        <a href="{{route("user.home")}}"><img src="/asset/images/logo.PNG" alt="logo"></a>
    </div>
    <div class="action_header">
        <div class="dot_heart">
            <img src="/asset/images/Heart.png" alt="">
        </div>
        <div class="create_post">
            <button id="btn_post">Đăng bài</button>
        </div>
        <div class="profile">
            @if(Auth::check())
                <div class="text">
                    <p class="name">
                        Phạm Huy Hưng
                    </p>
                    <p class="rank">
                        Proplayer
                    </p>
                </div>
                <div class="avt">
                    <img src="/asset/images/avt.jpg" alt="avt">
                </div>
            @else
                <div class="create_post" style="margin-right: 30px">
                    <a href="{{route("user.login.view")}}">
                        <button id="btn_post">Đăng nhập</button>
                    </a>
                </div>
            @endif

        </div>
    </div>
</div>
