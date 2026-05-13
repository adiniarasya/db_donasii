<h1>Login</h1>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <p>Email</p>
    <input type="email" name="email">

    <br><br>

    <p>Password</p>
    <input type="password" name="password">

    <br><br>

    <input type="checkbox" name="remember">
    <label>Ingat Saya</label>

    <br><br>

    <button type="submit">Login</button>
</form>

<br>

<p>Belum punya akun?</p>

<a href="{{ route('register') }}">
    <button>Daftar</button>
</a>