<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Register DonasiKu</title>

  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet"
    href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet"
    href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- AdminLTE -->
  <link rel="stylesheet"
    href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
  <!-- AOS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <style>

    body{
        background: linear-gradient(135deg,#343a40,#007bff);
        min-height:100vh;
        overflow:hidden;
    }

    .register-box{
        width:450px;
    }

    .register-logo a{
        color:white;
        font-size:38px;
        font-weight:bold;
    }

    .card{
        border:none;
        border-radius:20px;
        overflow:hidden;
    }

    .register-card-body{
        border-radius:20px;
        padding:40px;
    }

    .btn-primary{
    border-radius:10px;
    background: linear-gradient(135deg,#343a40,#007bff);
    border:none;
    transition:0.3s;
    }

    .btn-primary:hover{
        background: linear-gradient(135deg,#2c3136,#0056b3);
        transform:translateY(-2px);
    }

    .form-control{
        border-radius:10px;
        height:45px;
    }

    .input-group-text{
        border-radius:0 10px 10px 0;
    }

    .login-link{
        text-align:center;
        margin-top:20px;
    }

    .login-link a{
    color:#007bff;
    font-weight:bold;
    text-decoration:none;
    transition:0.3s;
    }

    .login-link a:hover{
        color:#0056b3;
    }

  </style>
</head>

<body class="hold-transition register-page">

<div class="register-box" data-aos="zoom-in">

    <!-- LOGO -->
    <div class="register-logo">
        <a href="/">
            <i class="fas fa-hand-holding-heart"></i>
            <b>DonasiKu</b>
        </a>
    </div>

    <!-- CARD -->
    <div class="card shadow-lg">
        <div class="card-body register-card-body">
            <p class="login-box-msg">
                Buat akun untuk mulai berdonasi ✨
            </p>
            <!-- ERROR -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <!-- NAMA -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <select name="role" class="form-control" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="donatur">Donatur</option>
                        <option value="kurir">Kurir</option>
                    </select>

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user-tag"></span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block py-2">
                    <i class="fas fa-user-plus"></i> Daftar
                </button>
            </form>

            <div class="login-link"> Sudah punya akun?
                <a href="{{ route('login') }}">
                    Login
                </a>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
<!-- AOS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>

    AOS.init({
        duration:1000,
        once:true
    });

</script>

</body>
</html>