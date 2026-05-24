@extends('template.layout')
@section('title', 'Manajemen Donasi')
@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="card-title mb-0">
                        <i class="fas fa-hand-holding-usd mr-2"></i>
                        Manajemen Donasi
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.donasi.index') }}">
                        <div class="row">

                            <!-- Status -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="">Semua</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}> Pending </option>
                                        <option value="diverifikasi" {{ request('status') == 'diverifikasi' ? 'selected' : '' }}> Diverifikasi </option>
                                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}> Selesai </option>
                                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}> Ditolak </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Jenis -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jenis Donasi</label>
                                    <select name="jenis" class="form-control">
                                        <option value="">Semua</option>
                                        <option value="uang" {{ request('jenis') == 'uang' ? 'selected' : '' }}> Uang </option>
                                        <option value="barang" {{ request('jenis') == 'barang' ? 'selected' : '' }}> Barang </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Tanggal Mulai -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Mulai</label>
                                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                                </div>
                            </div>

                            <!-- Tanggal Akhir -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Akhir</label>
                                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter"></i>
                                Filter
                            </button>
                            <a href="{{ route('admin.donasi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-sync"></i> Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="donasiTable">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>ID</th>
                                    <th>Donatur</th>
                                    <th>Jenis</th>
                                    <th>Detail</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($donasis as $donasi)
                                <tr>
                                    <td> #{{ $donasi->id }} </td>
                                    <td> {{ $donasi->user->name }} </td>
                                    <td>
                                        @if($donasi->jenis_donasi == 'uang')
                                            <span class="badge badge-primary">
                                                Uang
                                            </span>
                                        @else
                                            <span class="badge badge-success">
                                                Barang
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($donasi->jenis_donasi == 'uang')
                                            <strong>
                                                Rp {{ number_format($donasi->nominal, 0, ',', '.') }}
                                            </strong>
                                        @else
                                            <strong>
                                                {{ $donasi->nama_barang }}
                                            </strong>
                                            <br>
                                            <small>
                                                {{ $donasi->jumlah_barang }} pcs
                                                -
                                                {{ ucfirst($donasi->kondisi) }}
                                            </small>
                                        @endif
                                    </td>
                                    <td> {{ date('d/m/Y', strtotime($donasi->tanggal)) }} </td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'pending' => 'warning',
                                                'diverifikasi' => 'info',
                                                'selesai' => 'success',
                                                'ditolak' => 'danger'
                                            ];
                                        @endphp
                                        <span class="badge badge-{{ $statusColors[$donasi->status] ?? 'secondary' }}"> {{ ucfirst($donasi->status) }} </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.donasi.show', $donasi->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center"> Belum ada data donasi </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $donasis->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#donasiTable').DataTable({
            "pageLength": 25,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
            }
        });
    });
</script>

@endpush