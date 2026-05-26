<aside class="main-sidebar elevation-4" style="background: linear-gradient(180deg, #020617 0%, #0f172a 45%, #1d4ed8 100%);">

    <!-- Logo -->
    <a href="{{ route('home') }}" class="brand-link pb-3">
        <i class="fas fa-hand-holding-heart brand-image img-circle elevation-3" style="opacity: .8; color:white; margin-top:5px;"></i>
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
                <a href="#" class="d-block text-white font-weight-bold">
                    {{ auth()->user()->name }}
                </a>
                <small class="text-white-50" style="font-size: 12px;">
                    <i class="fas fa-shield-alt"></i> 
                    {{ ucfirst(auth()->user()->role) }}
                </small>
            </div>
        </div>

        <!-- Divider -->
        <div class="px-3">
            <hr class="bg-white" style="opacity: 0.15; margin: 0.75rem 0;">
        </div>

        <!-- Menu Navigation -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                {{-- ==================== MENU ADMIN ==================== --}}
                @if(auth()->user()->role == 'admin')
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Data Donasi -->
                    <li class="nav-item">
                        <a href="{{ route('admin.donasi.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.donasi.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-hand-holding-usd"></i>
                            <p>Data Donasi</p>
                        </a>
                    </li>

                    <!-- Penjemputan -->
                    <li class="nav-item">
                        <a href="{{ route('admin.penjemputan.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.penjemputan.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-truck-loading"></i>
                            <p>Penjemputan</p>
                        </a>
                    </li>

                    <!-- Data Kurir -->
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
                @endif

                {{-- ==================== MENU KURIR ==================== --}}
                @if(auth()->user()->role == 'kurir')
                    <!-- Dashboard Kurir (bisa pakai route admin dashboard dulu atau buat sendiri) -->
                    <li class="nav-item">
                        <a href="{{ route('kurir.dashboard') }}" 
                           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Penjemputan (sesuai route kurir) -->
                    <li class="nav-item">
                        <a href="{{ route('kurir.penjemputan') }}" 
                           class="nav-link {{ request()->routeIs('kurir.penjemputan*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p>Daftar Penjemputan</p>
                        </a>
                    </li>
                @endif

                {{-- ==================== MENU DONATUR ==================== --}}
                @if(auth()->user()->role == 'donatur')
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('donatur.dashboard') }}" 
                           class="nav-link {{ request()->routeIs('donatur.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Buat Donasi -->
                    <li class="nav-item">
                        <a href="{{ route('donatur.donasi.create') }}" 
                           class="nav-link {{ request()->routeIs('donatur.donasi.create') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-plus-circle"></i>
                            <p>Buat Donasi</p>
                        </a>
                    </li>

                    <!-- Riwayat Donasi -->
                    <li class="nav-item">
                        <a href="{{ route('donatur.riwayat') }}" 
                           class="nav-link {{ request()->routeIs('donatur.riwayat') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-history"></i>
                            <p>Riwayat Donasi</p>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>

        <!-- Divider before Logout -->
        <div class="px-3 mt-4">
            <hr class="bg-white" style="opacity: 0.15; margin: 0.5rem 0;">
        </div>

        <!-- Logout Section (SAMA UNTUK SEMUA ROLE) -->
        <div class="mt-2 mb-3 px-2">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link btn btn-outline-danger w-100 text-left border-0 rounded-pill" 
                        style="background: rgba(220, 53, 69, 0.1); transition: all 0.3s ease;">
                    <i class="nav-icon fas fa-sign-out-alt mr-2"></i>
                    <span class="font-weight-bold">Logout</span>
                </button>
            </form>
        </div>
    </div>
    <!-- /.sidebar -->
</aside>

<style>
    /* Hover effect for nav-links */
    .nav-sidebar .nav-link:not(.active):hover {
        background: rgba(255, 255, 255, 0.08) !important;
        transform: translateX(5px);
        transition: all 0.2s ease;
    }

    /* Active link styling */
    .nav-sidebar .nav-link.active {
        background: linear-gradient(90deg, #1d4ed8 0%, #3b82f6 100%);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
    }

    /* Hover effect for logout button */
    .btn-outline-danger:hover {
        background-color: #dc3545 !important;
        color: white !important;
        transform: translateX(3px);
    }

    /* Custom scrollbar for sidebar */
    .sidebar {
        scrollbar-width: thin;
        scrollbar-color: #3b82f6 #1e293b;
    }

    .sidebar::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: #1e293b;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: #3b82f6;
        border-radius: 6px;
    }
</style>