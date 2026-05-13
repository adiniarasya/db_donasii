
@section('title', 'Dashboard')

@section('content')

<h1>Dashboard Admin</h1>

<p>Selamat Datang, {{ auth()->user()->name }}</p>

<hr>

<h3>Data Donasi</h3>

<p>Total Donasi Uang: Rp {{ $totalDonasiUang }}</p>

<p>Total Donasi Barang: {{ $totalDonasiBarang }}</p>

<p>Total Donatur: {{ $totalDonatur }}</p>

<p>Total Penjemputan: {{ $totalPenjemputan }}</p>

<p>Donasi Pending: {{ $donasiPending }}</p>

<hr>

<h3>Donasi Terbaru</h3>

<table border="1" cellpadding="10">
    <tr>
        <th>Donatur</th>
        <th>Jenis</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($recentDonasi as $donasi)
    <tr>
        <td>{{ $donasi->user->name }}</td>
        <td>{{ $donasi->jenis_donasi }}</td>
        <td>{{ $donasi->status }}</td>
        <td>
            <a href="{{ route('admin.donasi.show', $donasi->id) }}">
                <button>Detail</button>
            </a>
        </td>
    </tr>
    @endforeach

</table>
