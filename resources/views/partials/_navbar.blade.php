<nav class="pcoded-navbar  ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div ">
            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="/assets/images/avatar.png" alt="User-Profile-Image">
                    <div class="user-details">
                        <span>{{ Auth::user()->name }}</span>
                        <div id="more-details">አድሚን<i class="fa fa-chevron-down m-l-5"></i></div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a href="{{ route('admin.profile') }}"><i class="feather icon-user m-r-5"></i>ግለ ገፅ</a></li>
                    </ul>
                </div>
            </div>
            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item">
                    <a href="/" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-gauge"></i></span><span class="pcoded-mtext">ዳሽቦርድ</span></a>
                </li>
                @can('houses-categories-view')
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-folder-tree"></i></span><span class="pcoded-mtext">የቤት ምድቦች</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ route('admin.housecategories') }}">ሁሉንም ለማየት</a></li>
                        @can('houses-categories-create')
                        <li><a href="{{ route('admin.housecategory.create') }}">አዲስ ለመመዝገብ</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('houses-view')
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-house-chimney-window"></i></span><span class="pcoded-mtext">ቤቶች</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ route('admin.houses') }}">ሁሉንም ለማየት</a></li>
                        @can('houses-create')
                        <li><a href="{{ route('admin.house.create') }}">አዲስ ለመመዝገብ</a></li>
                        <li><a href="{{ route('import.houses.form') }}">የመኖሪያ ቤቶች በብዛት ለመመዝገብ</a></li>
                        <li><a href="{{ route('mimport.houses.form') }}">የንግድ ቤቶች በብዛት ለመመዝገብ</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('station-view')
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-location-dot"></i></span><span class="pcoded-mtext">ጣቢያዎች</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ route('admin.bidderstation') }}">ሁሉንም ለማየት</a></li>
                        @can('station-create')
                        <li><a href="{{ route('admin.BidderStation.create') }}">አዲስ ለመመዝገብ</a></li>
                        @endcan

                    </ul>
                </li>
                @endcan
                @can('view-bidder')
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-money-bill-trend-up"></i></span><span class="pcoded-mtext">ተጫራቾች</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ route('admin.bidders') }}">ሁሉንም ለማየት</a></li>
                        @can('create-bidder')
                        <li><a href="{{ route('bidders.create') }}">አዲስ ለመመዝገብ</a></li>
                        @endcan
                        @can('edit-bidder')
                        <li><a href="{{ route('admin.bidders.update') }}">ተጫራች ለማዘመን</a></li>
                        @endcan

                        @can('view-bidders-topBidders')
                        <li><a href="{{ route('admin.topBidders') }}">አሸናፊ ተጫራቾች</a></li>
                        @endcan
                        @can('view-bidders-disqualifiedBidders-system')
                        <li><a href="{{ route('disqualifiedBidders') }}">ውድቅ የተደረጉ ተጫራቾች</a></li>
                        @endcan
                        @can('create-bidder')
                        <li><a href="{{ route('import.bidders.form') }}">በብዛት ለመመዝገብ</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('user-view')
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-users"></i></span><span class="pcoded-mtext">ተጠቃሚዎች</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ route('admin.users') }}">ሁሉንም ለማየት</a></li>
                        @can('user-create')
                        <li><a href="{{ route('admin.user.create') }}">አዲስ ለመመዝገብ</a></li>
                        @endcan
                        @can('role-view')
                        <li><a href="{{route('roles.index')}}">የተጠቃሚዎች ሚና</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('disqualified-bidders-view')
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-file-excel"></i></span><span class="pcoded-mtext">ውድቅ የተደረጉ ተጫራቾች</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ route('admin.specialdisqualifiedbidders') }}">ሁሉንም ለማየት</a></li>
                        @can('disqualified-bidders-update')
                        <li><a href="{{ route('admin.specialdisqualifiedbidders.update.form') }}">አዲስ ለመመዝገብ</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('agreement-accesss')
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-file-contract"></i></span><span class="pcoded-mtext">ውል</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ route('admin.agreements') }}">ሁሉንም ለማየት</a></li>
                        @can('agreement-create')
                        <li><a href="{{ route('admin.agreement.create') }}">አዲስ ለማዋዋል</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-gear"></i></span><span class="pcoded-mtext">መቼት</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ route('admin.profile') }}">ግለ ገፅ</a></li>
                        <li><a href="{{ route('password') }}">የይልፈ ቃል</a></li>
                        @can('log-access')
                        <li><a href="{{ route('admin.logs') }}">ክንውኖች</a></li>
                        @endcan
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>