
@section('title', 'Detail Donasi')

@section('content')

<h1>Detail Donasi</h1>

<p>ID Donasi: {{ $donasi->id }}</p>

<p>Nama Donatur: {{ $donasi->user->name }}</p>

<p>Email: {{ $donasi->user->email }}</p>

<p>Jenis Donasi: {{ $donasi->jenis_donasi }}</p>

@if($donasi->jenis_donasi == 'uang')
    <p>Nominal: Rp {{ $donasi->nominal }}</p>
@else
    <p>Nama Barang: {{ $donasi->nama_barang }}</p>
    <p>Jumlah Barang: {{ $donasi->jumlah_barang }}</p>
    <p>Kondisi: {{ $donasi->kondisi }}</p>
@endif

<p>Deskripsi: {{ $donasi->deskripsi }}</p>

<p>Status: {{ $donasi->status }}</p>

<p>Tanggal: {{ $donasi->tanggal }}</p>

<br>

@if($donasi->status == 'pending')

<form action="{{ route('admin.donasi.verifikasi', $donasi->id) }}" method="POST">
    @csrf
    <button type="submit">Verifikasi</button>
</form>

<br>

<form action="{{ route('admin.donasi.tolak', $donasi->id) }}" method="POST">
    @csrf
    <button type="submit">Tolak</button>
</form>

@endif

<br>

<a href="{{ route('admin.donasi.index') }}">
    <button>Kembali</button>
</a>
