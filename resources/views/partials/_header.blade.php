<header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="#!" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <img src="/assets/images/logo_white.png" style="width: 50px;" alt="" class="logo">
            <img src="/assets/images/logo_white.png" style="width: 50px;" alt="" class="logo-thumb">
        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <img src="/assets/images/avatar.png" class="img-radius" alt="User-Profile-Image">
                            <span>{{ Auth::user()->first_name }}</span>
                        </div>
                        <ul class="pro-body">
                            <li><a href="{{ route('admin.profile') }}" class="dropdown-item"><i class="feather icon-user"></i> ግለ ገፅ</a></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="dropdown-item"><i class="feather icon-lock"></i>ዘግተው ይውጡ</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>


</header>