<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <i class="fas fa-hand-holding-heart brand-image img-circle elevation-3" style="opacity: .8; color:white; margin-top:5px;"></i>
        <span class="brand-text font-weight-bold">
            DonasiKu
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>

            <div class="info">
                <a href="#" class="d-block">
                    {{ auth()->user()->name }}
                </a>
                <small class="text-success">
                    Admin
                </small>
            </div>
        </div>

        <!-- Search -->
        <div class="form-inline mb-3">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Donasi -->
                <li class="nav-item">
                    <a href="{{ route('admin.donasi.index') }}"
                       class="nav-link {{ request()->routeIs('admin.donasi.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-hand-holding-usd"></i>
                        <p>Data Donasi</p>
                    </a>
                </li>

                <!-- Kurir -->
                <li class="nav-item">
                    <a href="{{ route('admin.kurir.index') }}"
                       class="nav-link {{ request()->routeIs('admin.kurir.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>Data Kurir</p>
                    </a>
                </li>

                <!-- Laporan -->
                <li class="nav-item">
                    <a href="{{ route('admin.laporan.index') }}"
                       class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Laporan</p>
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item mt-3">
                    <form action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="nav-link btn btn-danger w-100 text-left border-0">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p class="mb-0">
                                Logout
                            </p>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>