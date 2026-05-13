

@section('title', 'Edit Kurir')

@section('content')

<h1>Edit Kurir</h1>

<form action="{{ route('admin.kurir.update', $kurir->id) }}" method="POST">
    @csrf
    @method('PUT')

    <p>Nama</p>
    <input type="text" name="name" value="{{ $kurir->name }}">

    <br><br>

    <p>Email</p>
    <input type="email" name="email" value="{{ $kurir->email }}">

    <br><br>

    <p>Password</p>
    <input type="password" name="password">

    <br><br>

    <p>Nomor HP</p>
    <input type="text" name="no_hp" value="{{ $kurir->kurirProfile->no_hp ?? '' }}">

    <br><br>

    <p>Alamat</p>
    <textarea name="alamat">{{ $kurir->kurirProfile->alamat ?? '' }}</textarea>

    <br><br>

    <button type="submit">Update</button>

</form>

<br>

<a href="{{ route('admin.kurir.index') }}">
    <button>Kembali</button>
</a>

