@extends('template.layout')

@section('title', 'Dashboard Admin')

@section('content')

<style>
    .gradient-header {
        background: linear-gradient(135deg, #0f172a, #2563eb);
        border-radius: 18px;
        color: white;
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.25);
    }

    .stat-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }

    .stat-icon {
        width: 55px;
        height: 55px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .stat-title {
        font-size: 13px;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-value {
        font-size: 28px;
        font-weight: bold;
        color: #1e293b;
    }

    .custom-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }

    .card-header-custom {
        background: linear-gradient(135deg, #0f172a, #2563eb);
        color: white;
        padding: 16px 20px;
        border: none;
    }

    .card-header-custom h4 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
    }

    .table-custom thead {
        background: linear-gradient(135deg, #0f172a, #2563eb);
        color: white;
    }

    .table-custom thead th {
        border: none;
        padding: 14px;
        font-size: 13px;
        font-weight: 600;
    }

    .table-custom tbody td {
        vertical-align: middle;
        padding: 12px;
    }

    .table-custom tbody tr:hover {
        background-color: #f8f9ff;
    }

    .alert-custom {
        border-radius: 16px;
        border-left: 5px solid #f59e0b;
        background: #fef3c7;
        color: #92400e;
    }

    .btn-detail {
        background: linear-gradient(135deg, #0f172a, #2563eb);
        border: none;
        border-radius: 8px;
        padding: 5px 12px;
        font-size: 12px;
        transition: .3s;
    }

    .btn-detail:hover {
        transform: translateY(-2px);
        color: white;
    }

    .badge-uang {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
    }

    .badge-barang {
        background: linear-gradient(135deg, #059669, #10b981);
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
    }

    .badge-pending {
        background: #f59e0b;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
    }

    .badge-diverifikasi {
        background: #3b82f6;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
    }

    .badge-selesai {
        background: #10b981;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
    }

    .badge-ditolak {
        background: #ef4444;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
    }
</style>

<div class="container-fluid">

    {{-- HEADER GRADIENT --}}
    <div class="gradient-header p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-1 font-weight-bold">
                    <i class="fas fa-chart-line mr-2"></i>
                    Selamat Datang, {{ auth()->user()->name }}!
                </h3>
                <small>
                    <i class="fas fa-tachometer-alt mr-1"></i>
                    Kelola donasi, kurir, dan lihat laporan donasi di sini.
                </small>
            </div>
            <div>
                <span class="badge bg-white text-dark px-3 py-2">
                    <i class="fas fa-calendar-alt"></i> {{ date('d F Y') }}
                </span>
            </div>
        </div>
    </div>

    {{-- STATISTIK CARDS --}}
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card stat-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-title">
                                <i class="fas fa-money-bill-wave mr-1"></i> Total Donasi Uang
                            </div>
                            <div class="stat-value text-primary">
                                Rp {{ number_format($totalDonasiUang,0,',','.') }}
                            </div>
                        </div>
                        <div class="stat-icon" style="background: rgba(37, 99, 235, 0.1);">
                            <i class="fas fa-hand-holding-usd text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card stat-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-title">
                                <i class="fas fa-box mr-1"></i> Total Donasi Barang
                            </div>
                            <div class="stat-value text-success">
                                {{ number_format($totalDonasiBarang,0,',','.') }} <span style="font-size: 14px;">Item</span>
                            </div>
                        </div>
                        <div class="stat-icon" style="background: rgba(5, 150, 105, 0.1);">
                            <i class="fas fa-gift text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card stat-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-title">
                                <i class="fas fa-users mr-1"></i> Total Donatur
                            </div>
                            <div class="stat-value text-info">
                                {{ number_format($totalDonatur,0,',','.') }} <span style="font-size: 14px;">Orang</span>
                            </div>
                        </div>
                        <div class="stat-icon" style="background: rgba(59, 130, 246, 0.1);">
                            <i class="fas fa-user-friends text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card stat-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-title">
                                <i class="fas fa-truck mr-1"></i> Penjemputan Aktif
                            </div>
                            <div class="stat-value text-warning">
                                {{ number_format($totalPenjemputan,0,',','.') }}
                            </div>
                        </div>
                        <div class="stat-icon" style="background: rgba(245, 158, 11, 0.1);">
                            <i class="fas fa-tasks text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ALERT PENDING DONASI --}}
    @if($donasiPending > 0)
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-custom">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle fa-2x mr-3" style="color: #f59e0b;"></i>
                    <div>
                        <strong>Perhatian!</strong> Terdapat <strong>{{ $donasiPending }}</strong> 
                        donasi pending yang perlu diverifikasi.
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- DONASI TERBARU --}}
    <div class="row">
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-header-custom">
                    <h4>
                        <i class="fas fa-clock mr-2"></i>
                        Donasi Terbaru
                    </h4>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover table-custom">
                            <thead>
                                <tr>
                                    <th>Donatur</th>
                                    <th>Jenis Donasi</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th width="80">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentDonasi as $donasi)
                                <tr>
                                    <td>
                                        <strong>{{ $donasi->user->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $donasi->user->email }}</small>
                                    </td>
                                    <td>
                                        @if($donasi->jenis_donasi == 'uang')
                                            <span class="badge-uang text-white">
                                                <i class="fas fa-money-bill-wave"></i> Uang
                                            </span>
                                        @else
                                            <span class="badge-barang text-white">
                                                <i class="fas fa-box"></i> Barang
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($donasi->jenis_donasi == 'uang')
                                            <strong class="text-primary">
                                                Rp {{ number_format($donasi->nominal, 0, ',', '.') }}
                                            </strong>
                                        @else
                                            <strong class="text-success">{{ $donasi->nama_barang }}</strong>
                                            <br>
                                            <small>{{ $donasi->jumlah_barang }} pcs</small>
                                        @endif
                                    </td>
                                    <td>
                                        <i class="fas fa-calendar-alt text-muted mr-1"></i>
                                        {{ date('d/m/Y', strtotime($donasi->tanggal)) }}
                                    </td>
                                    <td>
                                        @php
                                            $statusClasses = [
                                                'pending' => 'badge-pending',
                                                'diverifikasi' => 'badge-diverifikasi',
                                                'selesai' => 'badge-selesai',
                                                'ditolak' => 'badge-ditolak'
                                            ];
                                        @endphp
                                        <span class="text-white {{ $statusClasses[$donasi->status] ?? 'badge-pending' }}">
                                            @if($donasi->status == 'pending')  Pending
                                            @elseif($donasi->status == 'diverifikasi')  Diverifikasi
                                            @elseif($donasi->status == 'selesai')  Selesai
                                            @else  Ditolak
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.donasi.show', $donasi->id) }}" class="btn btn-detail text-white">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i class="fas fa-inbox fa-3x mb-3 text-muted"></i>
                                        <p class="text-muted">Belum ada donasi terbaru</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection