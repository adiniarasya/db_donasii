
@section('title', 'Donasi')

@section('content')
<h1>Halaman Donasi</h1>

<p>Daftar Donasi</p>

<button>Tambah Donasi</button>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Donatur</th>
        <th>Jenis</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($donasis as $donasi)
    <tr>
        <td>{{ $donasi->id }}</td>
        <td>{{ $donasi->user->name }}</td>
        <td>{{ $donasi->jenis_donasi }}</td>
        <td>{{ $donasi->status }}</td>
        <td>
            <a href="{{ route('admin.donasi.show', $donasi->id) }}">
                <button>Lihat</button>
            </a>
        </td>
    </tr>
    @endforeach
</table>
