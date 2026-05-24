@extends('template.layout')
@section('title', 'Dashboard Admin')
@section('content')
<!-- Welcome -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card bg-primary">
            <div class="card-body">
                <h2>
                    <i class="fas fa-chart-line"></i>
                    Selamat Datang, Admin {{ auth()->user()->name }}!
                </h2>
                <p class="mb-0"> Kelola donasi, kurir, dan lihat laporan donasi di sini. </p>
            </div>
        </div>
    </div>
</div>

<!-- Statistik -->
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5>Total Donasi Uang</h5>
                <h2> Rp {{ number_format($totalDonasiUang,0,',','.') }} </h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5>Total Donasi Barang</h5>
                <h2> {{ $totalDonasiBarang }} Item </h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5>Total Donatur</h5>
                <h2> {{ $totalDonatur }} Orang </h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5>Penjemputan Aktif</h5>
                <h2> {{ $totalPenjemputan }} </h2>
            </div>
        </div>
    </div>

</div>

<!-- Alert Pending -->
@if($donasiPending > 0)
<div class="alert alert-warning mt-4">
    <i class="fas fa-exclamation-triangle"></i>
    Terdapat {{ $donasiPending }}
    donasi pending yang perlu diverifikasi.
</div>
@endif

<!-- Donasi Terbaru -->
<div class="card mt-4">
    <div class="card-header">
        <h4>
            <i class="fas fa-clock"></i>
            Donasi Terbaru
        </h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Donatur</th>
                    <th>Jenis Donasi</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                @forelse($recentDonasi as $donasi)

                <tr>
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
                            Rp {{ number_format($donasi->nominal,0,',','.') }}
                        @else
                            {{ $donasi->nama_barang }}
                            ({{ $donasi->jumlah_barang }} pcs)
                        @endif
                    </td>
                    <td> {{ date('d/m/Y', strtotime($donasi->tanggal)) }} </td>
                    <td>
                        <span class="badge badge-warning">
                            {{ ucfirst($donasi->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.donasi.show', $donasi->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-eye"></i>
                            Detail
                        </a>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="6" class="text-center"> Belum ada donasi </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>

@endsection