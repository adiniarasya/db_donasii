@extends('template.layout')

@section('title', 'Detail Donasi')

@section('content')

<style>
    .gradient-header {
        background: linear-gradient(135deg, #0f172a, #2563eb);
        border-radius: 18px;
        color: white;
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.25);
    }

    .detail-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        height: 100%;
    }

    .action-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }

    .info-table {
        width: 100%;
    }

    .info-table tr td {
        padding: 12px 8px;
        border-bottom: 1px solid #e2e8f0;
    }

    .info-table tr:last-child td {
        border-bottom: none;
    }

    .info-label {
        width: 35%;
        font-weight: 600;
        color: #475569;
    }

    .info-value {
        width: 65%;
        color: #1e293b;
    }

    .btn-verifikasi {
        background: linear-gradient(135deg, #059669, #10b981);
        border: none;
        border-radius: 12px;
        padding: 12px;
        font-weight: 600;
        transition: .3s;
    }

    .btn-verifikasi:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.4);
    }

    .btn-tolak {
        background: linear-gradient(135deg, #dc2626, #ef4444);
        border: none;
        border-radius: 12px;
        padding: 12px;
        font-weight: 600;
        transition: .3s;
    }

    .btn-tolak:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.4);
    }

    .btn-back {
        background: #64748b;
        border: none;
        border-radius: 12px;
        padding: 12px;
        font-weight: 600;
        transition: .3s;
    }

    .btn-back:hover {
        background: #475569;
        transform: translateY(-2px);
    }

    .badge-uang {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
    }

    .badge-barang {
        background: linear-gradient(135deg, #059669, #10b981);
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
    }

    .badge-pending {
        background: #f59e0b;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
    }

    .badge-diverifikasi {
        background: #3b82f6;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
    }

    .badge-selesai {
        background: #10b981;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
    }

    .badge-ditolak {
        background: #ef4444;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
    }

    .section-title {
        font-size: 18px;
        font-weight: bold;
        color: #0f172a;
        padding-bottom: 12px;
        border-bottom: 2px solid #2563eb;
        margin-bottom: 20px;
    }

    .donatur-avatar {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #0f172a, #2563eb);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<div class="container-fluid">

    {{-- HEADER GRADIENT --}}
    <div class="gradient-header p-4 mb-4">
        <div>
            <h3 class="mb-1 font-weight-bold">
                <i class="fas fa-info-circle mr-2"></i>
                Detail Donasi #{{ $donasi->id }}
            </h3>
            <small>
                <i class="fas fa-hand-holding-usd mr-1"></i>
                Informasi lengkap donasi dari donatur
            </small>
        </div>
    </div>

    <div class="row">
        
        {{-- DETAIL DONASI --}}
        <div class="col-md-8 mb-4">
            <div class="card detail-card">
                <div class="card-body p-4">

                    <div class="d-flex align-items-center mb-4">
                        <div class="donatur-avatar mr-3">
                            <i class="fas fa-user text-white fa-2x"></i>
                        </div>
                        <div>
                            <h4 class="mb-0" style="color: #0f172a;">{{ $donasi->user->name }}</h4>
                            <small class="text-muted">{{ $donasi->user->email }}</small>
                        </div>
                    </div>

                    <hr style="border-color: #e2e8f0;">

                    <div class="section-title">
                        <i class="fas fa-receipt mr-2" style="color: #2563eb;"></i>
                        Informasi Donasi
                    </div>

                    <table class="info-table">
                        <tr>
                            <td class="info-label">ID Donasi</td>
                            <td class="info-value">#{{ $donasi->id }}</td>
                        </tr>
                        <tr>
                            <td class="info-label">Jenis Donasi</td>
                            <td class="info-value">
                                @if($donasi->jenis_donasi == 'uang')
                                    <span class="badge-uang text-white">
                                        Uang
                                    </span>
                                @else
                                    <span class="badge-barang text-white">
                                    Barang
                                    </span>
                                @endif
                            </td>
                        </tr>

                        @if($donasi->jenis_donasi == 'uang')
                        <tr>
                            <td class="info-label">Nominal Donasi</td>
                            <td class="info-value">
                                <strong class="text-primary" style="font-size: 20px;">
                                    Rp {{ number_format($donasi->nominal, 0, ',', '.') }}
                                </strong>
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td class="info-label">Nama Barang</td>
                            <td class="info-value">
                                <strong>{{ $donasi->nama_barang }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <td class="info-label">Jumlah Barang</td>
                            <td class="info-value">{{ $donasi->jumlah_barang }} pcs</td>
                        </tr>
                        <tr>
                            <td class="info-label">Kondisi Barang</td>
                            <td class="info-value">
                                @if($donasi->kondisi == 'baru')
                                    <span class="badge badge-success">Baru</span>
                                @else
                                    <span class="badge badge-warning">Bekas</span>
                                @endif
                            </td>
                        </tr>
                        @endif

                        <tr>
                            <td class="info-label">Deskripsi</td>
                            <td class="info-value">{{ $donasi->deskripsi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="info-label">Tanggal Donasi</td>
                            <td class="info-value">
                                <i class="fas fa-calendar-alt text-muted mr-1"></i>
                                {{ date('d F Y', strtotime($donasi->tanggal)) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="info-label">Status Donasi</td>
                            <td class="info-value">
                                @php
                                    $statusClasses = [
                                        'pending' => 'badge-pending',
                                        'diverifikasi' => 'badge-diverifikasi',
                                        'selesai' => 'badge-selesai',
                                        'ditolak' => 'badge-ditolak'
                                    ];
                                @endphp
                                <span class="text-white {{ $statusClasses[$donasi->status] ?? 'badge-secondary' }}">
                                    @if($donasi->status == 'pending')  Pending
                                    @elseif($donasi->status == 'diverifikasi')  Diverifikasi
                                    @elseif($donasi->status == 'selesai')  Selesai
                                    @else  Ditolak
                                    @endif
                                </span>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>

        {{-- AKSI --}}
        <div class="col-md-4 mb-4">
            <div class="card action-card">
                <div class="card-body p-4">
                    <h5 class="font-weight-bold mb-4" style="color: #0f172a;">
                        <i class="fas fa-cog mr-2" style="color: #2563eb;"></i>
                        Aksi yang Tersedia
                    </h5>

                    @if($donasi->status == 'pending')
                        <form action="{{ route('admin.donasi.verifikasi', $donasi->id) }}" method="POST" class="mb-3">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-verifikasi text-white w-100" onclick="return confirm('Verifikasi donasi ini?')">
                                <i class="fas fa-check-circle mr-2"></i>
                                Verifikasi Donasi
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.donasi.tolak', $donasi->id) }}" method="POST" class="mb-3">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-tolak text-white w-100" onclick="return confirm('Tolak donasi ini?')">
                                <i class="fas fa-times-circle mr-2"></i>
                                Tolak Donasi
                            </button>
                        </form>
                    @elseif($donasi->status == 'diverifikasi')
                        <div class="alert alert-info text-center rounded-3">
                            <i class="fas fa-info-circle"></i>
                            Donasi sudah diverifikasi
                        </div>
                    @elseif($donasi->status == 'selesai')
                        <div class="alert alert-success text-center rounded-3">
                            <i class="fas fa-check-circle"></i>
                            Donasi telah selesai
                        </div>
                    @elseif($donasi->status == 'ditolak')
                        <div class="alert alert-danger text-center rounded-3">
                            <i class="fas fa-times-circle"></i>
                            Donasi ditolak
                        </div>
                    @endif

                    <a href="{{ route('admin.donasi.index') }}" class="btn btn-back text-white w-100">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Daftar Donasi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection