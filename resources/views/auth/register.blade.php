<h1>Register</h1>

<form method="POST" action="{{ route('register') }}">
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

    <p>Konfirmasi Password</p>
    <input type="password" name="password_confirmation">

    <br><br>

    <p>Role</p>
    <select name="role">
        <option value="donatur">Donatur</option>
        <option value="kurir">Kurir</option>
    </select>

    <br><br>

    <button type="submit">Daftar</button>
</form>

<br>

<p>Sudah punya akun?</p>

<a href="{{ route('login') }}">
    <button>Login</button>
</a>