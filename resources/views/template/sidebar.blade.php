<aside class="main-sidebar elevation-4" style="background: linear-gradient(180deg, #020617 0%, #0f172a 45%, #1d4ed8 100%);">

    <!-- Logo -->
    <a href="{{ route('home') }}" class="brand-link pb-3">
        <i class="fas fa-hand-holding-heart brand-image img-circle elevation-3" style="opacity:.8;color:white;margin-top:5px;"></i>
        <span class="brand-text font-weight-bold">
            DonasiKu
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User Panel -->
        <div class="user-panel mt-3 mb-3 pb-3 d-flex align-items-center">
            <div class="image">
                <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>

            <div class="info">
                <a href="#" class="d-block text-white font-weight-bold"> {{ auth()->user()->name }} </a>
                <small class="text-white-50" style="font-size:12px;">
                    <i class="fas fa-user-shield"></i>
                    {{ ucfirst(auth()->user()->role) }}
                </small>
            </div>
        </div>

        <!-- Divider -->
        <div class="px-3">
            <hr class="bg-white" style="opacity:.15;">
        </div>

        <!-- Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                {{-- ================= ADMIN ================= --}}
                @if(auth()->user()->role == 'admin')

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.donasi.index') }}" class="nav-link {{ request()->routeIs('admin.donasi.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-hand-holding-usd"></i>
                            <p>Data Donasi</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.kurir.index') }}" class="nav-link {{ request()->routeIs('admin.kurir.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-truck"></i>
                            <p>Data Kurir</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.laporan.index') }}" class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>Laporan</p>
                        </a>
                    </li>

                @endif

                {{-- ================= DONATUR ================= --}}
                @if(auth()->user()->role == 'donatur')

                    <li class="nav-item">
                        <a href="{{ route('donatur.dashboard') }}" class="nav-link {{ request()->routeIs('donatur.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('donatur.donasi.create') }}" class="nav-link {{ request()->routeIs('donatur.donasi.create') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-plus-circle"></i>
                            <p>Buat Donasi</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('donatur.riwayat') }}" class="nav-link {{ request()->routeIs('donatur.riwayat') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-history"></i>
                            <p>Riwayat Donasi</p>
                        </a>
                    </li>

                @endif

                {{-- ================= KURIR ================= --}}
                @if(auth()->user()->role == 'kurir')

                    <li class="nav-item">
                        <a href="{{ route('kurir.penjemputan') }}" class="nav-link {{ request()->routeIs('kurir.penjemputan*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-truck-loading"></i>
                            <p>Daftar Penjemputan</p>
                        </a>
                    </li>

                @endif

            </ul>
        </nav>

        <!-- Divider -->
        <div class="px-3 mt-4">
            <hr class="bg-white" style="opacity:.15;">
        </div>

        <!-- Logout -->
        <div class="mt-2 mb-3 px-2">
            <form action="{{ route('logout') }}" method="POST">
                {{ csrf_field() }}

                <button type="submit" class="nav-link btn btn-outline-danger w-100 text-left border-0 rounded-pill">
                    <i class="nav-icon fas fa-sign-out-alt mr-2"></i>
                    <span class="font-weight-bold"> Logout </span>
                </button>
            </form>
        </div>
    </div>
</aside>

<style>

    .nav-sidebar .nav-link:not(.active):hover{
        background:rgba(255,255,255,.08)!important;
        transform:translateX(5px);
        transition:.2s;
    }

    .nav-sidebar .nav-link.active{
        background:linear-gradient(90deg,#1d4ed8,#3b82f6);
        border-radius:8px;
        box-shadow:0 2px 6px rgba(0,0,0,.2);
    }

    .btn-outline-danger:hover{
        background:#dc3545!important;
        color:white!important;
        transform:translateX(3px);
    }

</style>