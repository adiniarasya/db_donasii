
@section('title', 'Tambah Kurir')

@section('content')

<h1>Tambah Kurir</h1>

<form action="{{ route('admin.kurir.store') }}" method="POST">
    @csrf

    <p>Nama</p>
    <input type="text" name="name">

    <br><br>

    <p>Email</p>
    <input type="email" name="email">

    <br><br>

    <p>Password</p>
    <input type="password" name="password">

    <br><br>

    <p>Nomor HP</p>
    <input type="text" name="no_hp">

    <br><br>

    <p>Alamat</p>
    <textarea name="alamat"></textarea>

    <br><br>

    <button type="submit">Simpan</button>

</form>

<br>

<a href="{{ route('admin.kurir.index') }}">
    <button>Kembali</button>
</a>

