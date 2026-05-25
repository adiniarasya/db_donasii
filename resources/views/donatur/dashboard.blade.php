<h1>Dashboard Donatur</h1>

<p>Selamat datang, {{ auth()->user()->name }}</p>

<hr>

<h3>Statistik Donasi</h3>

<p>Total Donasi Uang: Rp {{ $donasiUang }}</p>

<p>Total Donasi Barang: {{ $donasiBarang }}</p>

<p>Total Transaksi: {{ $totalDonasi }}</p>

<p>Donasi Selesai: {{ $donasiSelesai }}</p>

<hr>

<a href="{{ route('donatur.donasi.create') }}">
    <button>Donasi Sekarang</button>
</a>

<hr>

<h3>Riwayat Donasi</h3>

@if($recentDonasi->count() > 0)

<table border="1" cellpadding="10">

    <tr>
        <th>Tanggal</th>
        <th>Jenis</th>
        <th>Detail</th>
        <th>Status</th>
    </tr>

    @foreach($recentDonasi as $donasi)

    <tr>
        <td>{{ $donasi->tanggal }}</td>

        <td>{{ $donasi->jenis_donasi }}</td>

        <td>
            @if($donasi->jenis_donasi == 'uang')

                Rp {{ $donasi->nominal }}

            @else

                {{ $donasi->nama_barang }}

            @endif
        </td>

        <td>{{ $donasi->status }}</td>
    </tr>

    @endforeach

</table>

@else

<p>Belum ada donasi</p>

@endif