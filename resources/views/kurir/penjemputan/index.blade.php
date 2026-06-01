@extends('template.layout')

@section('title', 'Dashboard Penjemputan')

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

    .btn-update {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border: none;
        border-radius: 8px;
        padding: 6px 14px;
        font-size: 12px;
        transition: .3s;
        color: white;
    }

    .btn-update:hover {
        transform: translateY(-2px);
        background: linear-gradient(135deg, #1d4ed8, #2563eb);
        color: white;
    }

    .btn-proses {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        border: none;
        border-radius: 8px;
        padding: 6px 14px;
        font-size: 12px;
        transition: .3s;
        color: white;
    }

    .btn-proses:hover {
        transform: translateY(-2px);
        background: linear-gradient(135deg, #d97706, #b45309);
        color: white;
    }

    .badge-menunggu {
        background: #f59e0b;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
    }

    .badge-diproses {
        background: #3b82f6;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
    }

    .badge-menuju {
        background: #8b5cf6;
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

    .alert-custom {
        border-radius: 16px;
        border-left: 5px solid #f59e0b;
        background: #fef3c7;
        color: #92400e;
    }
</style>

<div class="container-fluid">
    @if(
        !auth()->user()->kurirProfile ||
        auth()->user()->kurirProfile->no_hp == '-' ||
        auth()->user()->kurirProfile->alamat == '-'
    )
    <div class="alert alert-warning">
        <strong>Profil belum lengkap!</strong>
        Silakan lengkapi nomor HP dan alamat terlebih dahulu agar admin dapat memberikan tugas penjemputan.

        <a href="{{ route('kurir.profil') }}" class="btn btn-warning btn-sm ml-2">
            Lengkapi Profil
        </a>
    </div>
    @endif

    {{-- HEADER GRADIENT --}}
    <div class="gradient-header p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-1 font-weight-bold">
                    <i class="fas fa-truck mr-2"></i>
                    Selamat Datang, Kurir {{ auth()->user()->name }}!
                </h3>
                <small>
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    Berikut adalah tugas penjemputan Anda
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
        <div class="col-md-4 mb-3">
            <div class="card stat-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-title">
                                <i class="fas fa-tasks mr-1"></i> Total Tugas
                            </div>
                            <div class="stat-value text-primary">
                                {{ auth()->user()->penjemputan->count() }}
                            </div>
                        </div>
                        <div class="stat-icon" style="background: rgba(37, 99, 235, 0.1);">
                            <i class="fas fa-tasks text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card stat-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-title">
                                <i class="fas fa-spinner mr-1"></i> Tugas Aktif
                            </div>
                            <div class="stat-value text-warning">
                                {{ auth()->user()->penjemputan->where('status', '!=', 'selesai')->count() }}
                            </div>
                        </div>
                        <div class="stat-icon" style="background: rgba(245, 158, 11, 0.1);">
                            <i class="fas fa-truck-loading text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card stat-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-title">
                                <i class="fas fa-check-circle mr-1"></i> Tugas Selesai
                            </div>
                            <div class="stat-value text-success">
                                {{ auth()->user()->penjemputan->where('status', 'selesai')->count() }}
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

    {{-- ALERT TUGAS AKTIF --}}
    @if(auth()->user()->penjemputan->where('status', '!=', 'selesai')->count() > 0)
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-custom">
                <div class="d-flex align-items-center">
                    <i class="fas fa-truck-loading fa-2x mr-3" style="color: #f59e0b;"></i>
                    <div>
                        <strong>Perhatian!</strong> Anda memiliki <strong>{{ auth()->user()->penjemputan->where('status', '!=', 'selesai')->count() }}</strong> 
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
                                    <th>Barang</th>
                                    <th>Alamat Penjemputan</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(auth()->user()->penjemputan as $penjemputan)
                                <tr>
                                    <td>
                                        <strong>{{ $loop->iteration }}</strong>
                                    </td>
                                    <td>
                                        <strong>{{ $penjemputan->donasi->user->name ?? '-' }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $penjemputan->donasi->user->email ?? '-' }}</small>
                                    </td>
                                    <td>
                                        <i class="fas fa-box text-muted mr-1"></i>
                                        {{ $penjemputan->donasi->nama_barang ?? '-' }}
                                        <br>
                                        <small class="text-muted">{{ $penjemputan->donasi->jumlah_barang ?? 0 }} pcs</small>
                                    </td>
                                    <td>
                                        <i class="fas fa-map-marker-alt text-muted mr-1"></i>
                                        {{ $penjemputan->alamat_jemput ?? '-' }}
                                        <br>
                                        <small class="text-muted">
                                            <i class="fas fa-phone mr-1"></i>
                                            {{ $penjemputan->donasi->no_hp ?? '-' }}
                                        </small>
                                    </td>
                                    <td>
                                        <i class="fas fa-calendar-alt text-muted mr-1"></i>
                                        {{ \Carbon\Carbon::parse($penjemputan->tanggal_jemput)->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        @php
                                            $statusClasses = [
                                                'menunggu' => 'badge-menunggu',
                                                'diproses' => 'badge-diproses',
                                                'menuju' => 'badge-menuju',
                                                'selesai' => 'badge-selesai'
                                            ];
                                        @endphp
                                        <span class="text-white {{ $statusClasses[$penjemputan->status] ?? 'badge-menunggu' }}">
                                            @if($penjemputan->status == 'menunggu')
                                                <i class="fas fa-clock"></i> Menunggu
                                            @elseif($penjemputan->status == 'diproses')
                                                <i class="fas fa-spinner"></i> Diproses
                                            @elseif($penjemputan->status == 'menuju')
                                                <i class="fas fa-truck"></i> Menuju
                                            @else
                                                <i class="fas fa-check-circle"></i> Selesai
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        @if($penjemputan->status != 'selesai')
                                            <form action="{{ route('kurir.penjemputan.update', $penjemputan->id) }}" method="POST">
                                                @csrf
                                                @if($penjemputan->status == 'menunggu')
                                                    <button type="submit" name="status" value="diproses" class="btn-proses">
                                                        <i class="fas fa-play"></i> Proses
                                                    </button>
                                                @elseif($penjemputan->status == 'diproses')
                                                    <button type="submit" name="status" value="menuju" class="btn-update">
                                                        <i class="fas fa-truck"></i> Menuju
                                                    </button>
                                                @elseif($penjemputan->status == 'menuju')
                                                    <button type="submit" name="status" value="selesai" class="btn-update">
                                                        <i class="fas fa-check"></i> Selesai
                                                    </button>
                                                @endif
                                            </form>
                                        @else
                                            <button class="btn-update" disabled style="opacity: 0.6; cursor: not-allowed;">
                                                <i class="fas fa-check-circle"></i> Selesai
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <i class="fas fa-inbox fa-3x mb-3 text-muted"></i>
                                        <h5 class="text-muted">Belum Ada Tugas Penjemputan</h5>
                                        <p class="text-muted">Tunggu admin memberikan tugas penjemputan</p>
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