@extends('template.layout')

@section('title', 'Riwayat Donasi Saya')

@section('content')

<style>
    .gradient-header {
        background: linear-gradient(135deg, #0f172a, #2563eb);
        border-radius: 18px;
        color: white;
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.25);
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

    .pagination-custom {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }

    .pagination-custom .pagination {
        gap: 5px;
    }

    .pagination-custom .page-item .page-link {
        border-radius: 10px;
        color: #1e293b;
        border: 1px solid #e2e8f0;
        padding: 8px 14px;
        transition: all 0.3s ease;
    }

    .pagination-custom .page-item.active .page-link {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border-color: #2563eb;
        color: white;
    }

    .pagination-custom .page-item .page-link:hover {
        background: #f1f5f9;
        transform: translateY(-2px);
    }

    .search-box {
        position: relative;
        margin-bottom: 20px;
    }

    .search-box input {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 10px 16px 10px 40px;
        width: 300px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .search-box input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        outline: none;
    }

    .search-box i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }

    .detail-box {
        background: #f8f9ff;
        border-radius: 10px;
        padding: 8px 12px;
        margin-top: 8px;
    }
</style>

<div class="container-fluid">

    {{-- HEADER GRADIENT --}}
    <div class="gradient-header p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-1 font-weight-bold">
                    <i class="fas fa-history mr-2"></i>
                    Riwayat Donasi Saya
                </h3>
                <small>
                    <i class="fas fa-chart-line mr-1"></i>
                    Lihat semua donasi yang telah Anda lakukan
                </small>
            </div>
            <div>
                <span class="badge bg-white text-dark px-3 py-2">
                    <i class="fas fa-calendar-alt"></i> {{ date('d F Y') }}
                </span>
            </div>
        </div>
    </div>

    {{-- RIWAYAT DONASI --}}
    <div class="row">
        <div class="col-12">
            <div class="custom-card">
                <div class="card-header-custom">
                    <h4>
                        <i class="fas fa-list-alt mr-2"></i>
                        Daftar Donasi
                    </h4>
                </div>
                <div class="card-body p-4">
                    
                    {{-- Search Box (Opsional) --}}
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Cari donasi..." class="form-control">
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-custom" id="donasiTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal</th>
                                    <th>Jenis Donasi</th>
                                    <th>Detail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($donasis as $donasi)
                                <tr>
                                    <td>
                                        <strong>#{{ $donasi->id }}</strong>
                                    </td>
                                    <td>
                                        <i class="fas fa-calendar-alt text-muted mr-1"></i>
                                        {{ $donasi->tanggal->format('d/m/Y') }}
                                        <br>
                                        <small class="text-muted">{{ $donasi->tanggal->format('H:i') }}</small>
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
                                            <strong class="text-primary" style="font-size: 16px;">
                                                Rp {{ number_format($donasi->nominal, 0, ',', '.') }}
                                            </strong>
                                            @if($donasi->deskripsi)
                                                <div class="detail-box">
                                                    <i class="fas fa-file-alt text-muted mr-1"></i>
                                                    <small class="text-muted">{{ Str::limit($donasi->deskripsi, 50) }}</small>
                                                </div>
                                            @endif
                                        @else
                                            <strong class="text-success">{{ $donasi->nama_barang }}</strong>
                                            <br>
                                            <small class="text-muted">
                                                <i class="fas fa-boxes"></i> {{ $donasi->jumlah_barang }} pcs
                                            </small>
                                            <br>
                                            <small class="text-muted">
                                                <i class="fas fa-clipboard-list"></i> 
                                                Kondisi: {{ ucfirst($donasi->kondisi ?? 'Baru') }}
                                            </small>
                                            @if($donasi->deskripsi)
                                                <div class="detail-box">
                                                    <i class="fas fa-file-alt text-muted mr-1"></i>
                                                    <small class="text-muted">{{ Str::limit($donasi->deskripsi, 50) }}</small>
                                                </div>
                                            @endif
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
                                            @if($donasi->status == 'pending') 
                                                Menunggu Verifikasi
                                            @elseif($donasi->status == 'diverifikasi') 
                                                Terverifikasi
                                            @elseif($donasi->status == 'selesai') 
                                                Selesai
                                            @elseif($donasi->status == 'ditolak') 
                                                Ditolak
                                            @else
                                                {{ ucfirst($donasi->status) }}
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="fas fa-inbox fa-3x mb-3 text-muted"></i>
                                        <h5 class="text-muted">Belum Ada Riwayat Donasi</h5>
                                        <p class="text-muted">Mulai donasi sekarang dengan klik tombol Donasi di dashboard</p>
                                        <a href="{{ route('donatur.donasi.create') }}" class="btn btn-primary mt-2" style="border-radius: 10px;">
                                            <i class="fas fa-hand-holding-heart"></i> Donasi Sekarang
                                        </a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- PAGINATION --}}
                    @if($donasis->hasPages())
                        <div class="pagination-custom">
                            {{ $donasis->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Simple search functionality
    document.getElementById('searchInput')?.addEventListener('keyup', function() {
        let searchValue = this.value.toLowerCase();
        let table = document.getElementById('donasiTable');
        let rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        
        for (let i = 0; i < rows.length; i++) {
            let row = rows[i];
            let textContent = row.textContent.toLowerCase();
            
            if (textContent.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
</script>

@endsection