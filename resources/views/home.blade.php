<h1>Platform Donasi</h1>

<p>Selamat datang di website donasi.</p>

@guest

<a href="{{ route('register') }}">
    <button>Daftar</button>
</a>

<a href="{{ route('login') }}">
    <button>Login</button>
</a>

@else

<a href="{{ route('donatur.donasi.create') }}">
    <button>Donasi Sekarang</button>
</a>

@endguest

<hr>

<h3>Statistik</h3>

<p>Total Donasi Uang: Rp {{ $totalDonasiUang }}</p>

<p>Total Donasi Barang: {{ $totalDonasiBarang }}</p>

<p>Total Donatur: {{ $totalDonatur }}</p>

<hr>

<h3>Donasi Terbaru</h3>

@foreach($recentDonasi as $donasi)

<p>Nama: {{ $donasi->user->name }}</p>

<p>Jenis: {{ $donasi->jenis_donasi }}</p>

@if($donasi->jenis_donasi == 'uang')

<p>Nominal: Rp {{ $donasi->nominal }}</p>

@else

<p>Barang: {{ $donasi->nama_barang }}</p>

@endif

<p>Status: {{ $donasi->status }}</p>

<hr>

@endforeach