
@section('title', 'Manajemen Kurir')

@section('content')

<h1>Data Kurir</h1>

<a href="{{ route('admin.kurir.create') }}">
    <button>Tambah Kurir</button>
</a>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>No HP</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>

    @foreach($kurirs as $kurir)
    <tr>
        <td>{{ $kurir->name }}</td>
        <td>{{ $kurir->email }}</td>
        <td>{{ $kurir->kurirProfile->no_hp ?? '-' }}</td>
        <td>{{ $kurir->kurirProfile->alamat ?? '-' }}</td>
        <td>
            <a href="{{ route('admin.kurir.edit', $kurir->id) }}">
                <button>Edit</button>
            </a>

            <form action="{{ route('admin.kurir.destroy', $kurir->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach

</table>

