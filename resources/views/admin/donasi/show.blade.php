@extends('template.layout')
@section('title', 'Detail Donasi')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-info-circle"></i>
                    Detail Donasi #{{ $donasi->id }}
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="35%">Donatur</th>
                        <td>
                            {{ $donasi->user->name }}
                            ({{ $donasi->user->email }})
                        </td>
                    </tr>
                    <tr>
                        <th>Jenis Donasi</th>
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
                    </tr>

                    {{-- DONASI UANG --}}
                    @if($donasi->jenis_donasi == 'uang')
                    <tr>
                        <th>Nominal</th>
                        <td> Rp {{ number_format($donasi->nominal,0,',','.') }} </td>
                    </tr>
                    @else
                    
                    {{-- DONASI BARANG --}}
                    <tr>
                        <th>Nama Barang</th>
                        <td> {{ $donasi->nama_barang }} </td>
                    </tr>
                    <tr>
                        <th>Jumlah Barang</th>
                        <td> {{ $donasi->jumlah_barang }} </td>
                    </tr>
                    <tr>
                        <th>Kondisi</th>
                        <td> {{ ucfirst($donasi->kondisi) }} </td>
                    </tr>
                    @endif
                    <tr>
                        <th>Deskripsi</th>
                        <td> {{ $donasi->deskripsi ?? '-' }} </td>
                    </tr>
                    <tr>
                        <th>Tanggal Donasi</th>
                        <td> {{ date('d F Y', strtotime($donasi->tanggal)) }} </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($donasi->status == 'pending')
                                <span class="badge badge-warning">
                                    Pending
                                </span>
                            @elseif($donasi->status == 'diverifikasi')
                                <span class="badge badge-info">
                                    Diverifikasi
                                </span>
                            @elseif($donasi->status == 'selesai')
                                <span class="badge badge-success">
                                    Selesai
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    Ditolak
                                </span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- AKSI -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"> Aksi yang Tersedia </h4>
            </div>
            <div class="card-body">
                @if($donasi->status == 'pending')
                    <form action="{{ route('admin.donasi.verifikasi', $donasi->id) }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-success btn-block mb-2" onclick="return confirm('Verifikasi donasi ini?')">
                            <i class="fas fa-check-circle"></i>
                            Verifikasi Donasi
                        </button>
                    </form>
                    <form action="{{ route('admin.donasi.tolak', $donasi->id) }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Tolak donasi ini?')">
                            <i class="fas fa-times-circle"></i>
                            Tolak Donasi
                        </button>
                    </form>
                @endif
                <a href="{{ route('admin.donasi.index') }}" class="btn btn-secondary btn-block mt-3">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection