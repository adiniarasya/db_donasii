@extends('template.layout')
@section('title', 'Manajemen Donasi')
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

    .table-custom thead {
        background: linear-gradient(135deg, #0f172a, #2563eb);
        color: white;
    }

    .table-custom thead th {
        border: none;
        padding: 16px;
        font-size: 14px;
        font-weight: 600;
    }

    .table-custom tbody td {
        vertical-align: middle;
        padding: 14px;
    }

    .table-custom tbody tr:hover {
        background-color: #f8f9ff;
    }

    .btn-detail {
        background: linear-gradient(135deg, #0f172a, #2563eb);
        border: none;
        border-radius: 8px;
        padding: 6px 12px;
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
        font-size: 12px;
    }

    .badge-barang {
        background: linear-gradient(135deg, #059669, #10b981);
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
    }

    .badge-pending {
        background: #f59e0b;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
    }

    .badge-diverifikasi {
        background: #3b82f6;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
    }

    .badge-selesai {
        background: #10b981;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
    }

    .badge-ditolak {
        background: #ef4444;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
    }
</style>

<div class="container-fluid">

    {{-- HEADER GRADIENT --}}
    <div class="gradient-header p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-1 font-weight-bold">
                    <i class="fas fa-hand-holding-usd mr-2"></i>
                    Manajemen Donasi
                </h3>
                <small>
                    <i class="fas fa-chart-line mr-1"></i>
                    Kelola dan pantau data donasi masuk
                </small>
            </div>
            <div>
                <span class="badge bg-white text-dark px-3 py-2">
                    <i class="fas fa-calendar-alt"></i> Total Donasi: {{ $donasis->total() }}
                </span>
            </div>
        </div>
    </div>

    {{-- TABEL DONASI --}}
    <div class="row">
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover table-custom" id="donasiTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Donatur</th>
                                    <th>Jenis</th>
                                    <th>Detail</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th width="100">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($donasis as $donasi)
                                <tr>
                                    <td class="font-weight-bold">#{{ $donasi->id }}</td>
                                    <td>
                                        <strong>{{ $donasi->user->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $donasi->user->email }}</small>
                                    </td>
                                    <td>
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
                                    <td>
                                        @if($donasi->jenis_donasi == 'uang')
                                            <strong class="text-primary">
                                                Rp {{ number_format($donasi->nominal, 0, ',', '.') }}
                                            </strong>
                                        @else
                                            <strong class="text-success">{{ $donasi->nama_barang }}</strong>
                                            <br>
                                            <small>
                                                {{ $donasi->jumlah_barang }} pcs | 
                                                Kondisi: {{ ucfirst($donasi->kondisi) }}
                                            </small>
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
                                        <span class="text-white {{ $statusClasses[$donasi->status] ?? 'badge-secondary' }}">
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
                                    <td colspan="7" class="text-center py-5">
                                        <i class="fas fa-inbox fa-3x mb-3 text-muted"></i>
                                        <p class="text-muted">Belum ada data donasi</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                Menampilkan {{ $donasis->firstItem() ?? 0 }} - {{ $donasis->lastItem() ?? 0 }} 
                                dari {{ $donasis->total() }} data
                            </small>
                        </div>
                        <div>
                            {{ $donasis->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        if ($('#donasiTable tbody tr').length > 0) {
            $('#donasiTable').DataTable({
                "paging": false,
                "searching": false,
                "info": false,
                "ordering": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
                }
            });
        }
    });
</script>
@endpush