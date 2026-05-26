@extends('template.layout')

@section('title', 'Dashboard Donatur')

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

    .btn-donasi {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border: none;
        border-radius: 10px;
        padding: 12px 24px;
        font-size: 14px;
        font-weight: 600;
        transition: .3s;
        color: white;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-donasi:hover {
        transform: translateY(-2px);
        background: linear-gradient(135deg, #1d4ed8, #2563eb);
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
                    <i class="fas fa-hand-holding-heart mr-2"></i>
                    Selamat Datang, {{ auth()->user()->name }}!
                </h3>
                <small>
                    <i class="fas fa-chart-line mr-1"></i>
                    Kelola donasi dan lihat riwayat donasi Anda di sini.
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
                                Rp {{ number_format($donasiUang, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="stat-icon" style="background: rgba(37, 99, 235, 0.1);">
                            <i class="fas fa-money-bill-wave text-primary"></i>
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
                                {{ number_format($donasiBarang, 0, ',', '.') }} <span style="font-size: 14px;">Item</span>
                            </div>
                        </div>
                        <div class="stat-icon" style="background: rgba(5, 150, 105, 0.1);">
                            <i class="fas fa-box text-success"></i>
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
                                <i class="fas fa-chart-line mr-1"></i> Total Transaksi
                            </div>
                            <div class="stat-value text-info">
                                {{ number_format($totalDonasi, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="stat-icon" style="background: rgba(59, 130, 246, 0.1);">
                            <i class="fas fa-chart-line text-info"></i>
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
                                <i class="fas fa-check-circle mr-1"></i> Donasi Selesai
                            </div>
                            <div class="stat-value text-success">
                                {{ number_format($donasiSelesai, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="stat-icon" style="background: rgba(16, 185, 129, 0.1);">
                            <i class="fas fa-check-circle text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- BUTTON DONASI --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="text-center">
                <a href="{{ route('donatur.donasi.create') }}" class="btn-donasi">
                    <i class="fas fa-hand-holding-heart"></i> Donasi Sekarang
                </a>
            </div>
        </div>
    </div>

    {{-- RIWAYAT DONASI --}}
    <div class="row">
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-header-custom">
                    <h4>
                        <i class="fas fa-history mr-2"></i>
                        Riwayat Donasi
                    </h4>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover table-custom">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis Donasi</th>
                                    <th>Detail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentDonasi as $donasi)
                                <tr>
                                    <td>
                                        <i class="fas fa-calendar-alt text-muted mr-1"></i>
                                        {{ date('d/m/Y', strtotime($donasi->tanggal)) }}
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
                                            <small class="text-muted">{{ $donasi->jumlah_barang }} pcs</small>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $statusClasses = [
                                                'pending' => 'badge-pending',
                                                'diverifikasi' => 'badge-diverifikasi',
                                                'selesai' => 'badge-selesai',
                                                'ditolak' => 'badge-ditolak'
                                            ];
                                            $statusIcons = [
                                                'pending' => 'fa-clock',
                                                'diverifikasi' => 'fa-check-circle',
                                                'selesai' => 'fa-check-double',
                                                'ditolak' => 'fa-times-circle'
                                            ];
                                        @endphp
                                        <span class="text-white {{ $statusClasses[$donasi->status] ?? 'badge-pending' }}">
                                            <i class="fas {{ $statusIcons[$donasi->status] ?? 'fa-clock' }}"></i>
                                            @if($donasi->status == 'pending') Pending
                                            @elseif($donasi->status == 'diverifikasi') Diverifikasi
                                            @elseif($donasi->status == 'selesai') Selesai
                                            @else Ditolak
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <i class="fas fa-inbox fa-3x mb-3 text-muted"></i>
                                        <h5 class="text-muted">Belum Ada Donasi</h5>
                                        <p class="text-muted">Mulai donasi sekarang dengan klik tombol di atas</p>
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