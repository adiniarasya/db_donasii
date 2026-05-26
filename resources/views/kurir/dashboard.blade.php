@extends('template.layout')

@section('title', 'Dashboard Kurir')

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

    .btn-update {
        background: linear-gradient(135deg, #059669, #10b981);
        border: none;
        border-radius: 8px;
        padding: 5px 12px;
        font-size: 12px;
        transition: .3s;
        color: white;
    }

    .btn-update:hover {
        transform: translateY(-2px);
        background: linear-gradient(135deg, #047857, #059669);
        color: white;
    }

    .badge-pending {
        background: #f59e0b;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
    }

    .badge-proses {
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
</style>

<div class="container-fluid">

    {{-- HEADER GRADIENT --}}
    <div class="gradient-header p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-1 font-weight-bold">
                    <i class="fas fa-truck mr-2"></i>
                    Selamat Datang, {{ auth()->user()->name }}!
                </h3>
                <small>
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    Kelola tugas penjemputan donasi di sini.
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
        <div class="col-md-6 mb-3">
            <div class="card stat-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-title">
                                <i class="fas fa-tasks mr-1"></i> Total Tugas
                            </div>
                            <div class="stat-value text-primary">
                                {{ number_format($totalTugas,0,',','.') }}
                            </div>
                        </div>
                        <div class="stat-icon" style="background: rgba(37, 99, 235, 0.1);">
                            <i class="fas fa-tasks text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card stat-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-title">
                                <i class="fas fa-spinner mr-1"></i> Tugas Aktif
                            </div>
                            <div class="stat-value text-warning">
                                {{ number_format($tugasAktif,0,',','.') }}
                            </div>
                        </div>
                        <div class="stat-icon" style="background: rgba(245, 158, 11, 0.1);">
                            <i class="fas fa-truck-loading text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ALERT TUGAS AKTIF --}}
    @if($tugasAktif > 0)
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-custom" style="border-radius: 16px; border-left: 5px solid #f59e0b; background: #fef3c7; color: #92400e;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-truck-loading fa-2x mr-3" style="color: #f59e0b;"></i>
                    <div>
                        <strong>Perhatian!</strong> Anda memiliki <strong>{{ $tugasAktif }}</strong> 
                        tugas penjemputan yang perlu diselesaikan.
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- DAFTAR TUGAS PENJEMPUTAN --}}
    <div class="row">
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-header-custom">
                    <h4>
                        <i class="fas fa-clipboard-list mr-2"></i>
                        Daftar Tugas Penjemputan
                    </h4>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover table-custom">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Donatur</th>
                                    <th>Alamat Penjemputan</th>
                                    <th>Jenis Donasi</th>
                                    <th>Status</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($penjemputan as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $loop->iteration }}</strong>
                                    </td>
                                    <td>
                                        <strong>{{ $item->donasi->user->name ?? '-' }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $item->donasi->user->email ?? '-' }}</small>
                                    </td>
                                    <td>
                                        <i class="fas fa-map-marker-alt text-muted mr-1"></i>
                                        {{ $item->alamat_jemput ?? '-' }}
                                        <br>
                                        <small class="text-muted">
                                            <i class="fas fa-phone mr-1"></i>
                                            {{ $item->donasi->no_hp ?? '-' }}
                                        </small>
                                    </td>
                                    <td>
                                        @if($item->donasi->jenis_donasi == 'uang')
                                            <span class="badge-pending text-white">
                                                <i class="fas fa-money-bill-wave"></i> Uang
                                            </span>
                                            <br>
                                            <small class="text-muted mt-1 d-inline-block">
                                                Rp {{ number_format($item->donasi->nominal, 0, ',', '.') }}
                                            </small>
                                        @else
                                            <span class="badge-proses text-white">
                                                <i class="fas fa-box"></i> Barang
                                            </span>
                                            <br>
                                            <small class="text-muted mt-1 d-inline-block">
                                                {{ $item->donasi->nama_barang ?? '-' }} ({{ $item->donasi->jumlah_barang ?? 0 }} pcs)
                                            </small>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $statusClasses = [
                                                'pending' => 'badge-pending',
                                                'proses' => 'badge-proses',
                                                'selesai' => 'badge-selesai'
                                            ];
                                        @endphp
                                        <span class="text-white {{ $statusClasses[$item->status] ?? 'badge-pending' }}">
                                            @if($item->status == 'pending') 
                                                <i class="fas fa-clock"></i> Pending
                                            @elseif($item->status == 'proses') 
                                                <i class="fas fa-spinner"></i> Proses
                                            @else 
                                                <i class="fas fa-check-circle"></i> Selesai
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        @if($item->status != 'selesai')
                                            <form action="{{ route('kurir.penjemputan.update', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-update">
                                                    <i class="fas fa-check-circle"></i> Update Status
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-detail text-white" disabled style="opacity: 0.6;">
                                                <i class="fas fa-check-circle"></i> Selesai
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i class="fas fa-inbox fa-3x mb-3 text-muted"></i>
                                        <p class="text-muted">Belum ada tugas penjemputan</p>
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