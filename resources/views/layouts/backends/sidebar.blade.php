<div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo">
                    <a href="index.html"><img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo"
                        srcset=""></a>
            </div>
            <div class="toggler">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i
                        class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>


            <li class="sidebar-item {{ Route::is('admin.home*') ? 'active' : '' }}">
                <a href="{{ route('admin.home') }}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('hero*') ? 'active' : '' }}">
                <a href="{{ route('hero.index') }}" class='sidebar-link'>
                    <i class="bi bi-image-fill"></i>
                    <span>Hero</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('promotion*') ? 'active' : '' }}">
                <a href="{{ route('promotion.index') }}" class='sidebar-link'>
                    <i class="bi bi-gift-fill"></i>
                    <span>Promotion</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('application*') ? 'active' : '' }}">
                <a href="{{ route('application.index') }}" class='sidebar-link'>
                    <i class="bi bi-phone-fill"></i>
                    <span>Application</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('city*') ? 'active' : '' }}">
                <a href="{{ route('city.index') }}" class='sidebar-link'>
                    <i class="bi bi-geo-alt"></i>
                    <span>City</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('kosan*') ? 'active' : '' }}">
                <a href="{{ route('kosan.index') }}" class='sidebar-link'>
                    <i class="bi bi-buildings-fill"></i>
                    <span>Kosan</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('ruang*') ? 'active' : '' }}">
                <a href="{{ route('ruang.index') }}" class='sidebar-link'>
                    <i class="bi bi-buildings-fill"></i>
                    <span>Ruang</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('order*') ? 'active' : '' }}">
                <a href="{{ route('order.index') }}" class='sidebar-link'>
                    <i class="bi bi-buildings-fill"></i>
                    <span>Order</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('bank*') ? 'active' : '' }}">
                <a href="{{ route('bank.index') }}" class='sidebar-link'>
                    <i class="bi bi-buildings-fill"></i>
                    <span>Bank</span>
                </a>
            </li>

            <hr>

            <li class="sidebar-item  ">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class='sidebar-link'>
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Logout</span>
                </a>
            </li>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>


        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>
