
@section('title', 'Laporan')

@section('content')

<h1>Laporan Donasi</h1>

<p>Total Donasi Uang: Rp {{ $totalUang }}</p>

<p>Total Donasi Barang: {{ $totalBarang }}</p>

<p>Total Donatur: {{ $totalDonatur }}</p>

<br>

<table border="1" cellpadding="10">
    <tr>
        <th>Periode</th>
        <th>Donasi Uang</th>
        <th>Donasi Barang</th>
        <th>Jumlah Donatur</th>
        <th>Aksi</th>
    </tr>

    @foreach($laporans as $laporan)
    <tr>
        <td>{{ $laporan->periode }}</td>
        <td>Rp {{ $laporan->total_donasi_uang }}</td>
        <td>{{ $laporan->total_donasi_barang }}</td>
        <td>{{ $laporan->jumlah_donatur }}</td>
        <td>
            <button>Cetak</button>
        </td>
    </tr>
    @endforeach

</table>
