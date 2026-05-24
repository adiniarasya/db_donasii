<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Login DonasiKu</title>

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

  <!-- AOS Animation -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>

    body{
        background: linear-gradient(135deg,#667eea,#764ba2);
        min-height:100vh;
        overflow:hidden;
    }

    .login-box{
        width:420px;
    }

    .login-logo a{
        color:white;
        font-size:38px;
        font-weight:bold;
    }

    .card{
        border:none;
        border-radius:20px;
        overflow:hidden;
        backdrop-filter: blur(10px);
    }

    .login-card-body{
        border-radius:20px;
        padding:40px;
    }

    .btn-primary{
        border-radius:10px;
        background: linear-gradient(135deg,#667eea,#764ba2);
        border:none;
    }

    .btn-primary:hover{
        opacity:0.9;
    }

    .form-control{
        border-radius:10px;
        height:45px;
    }

    .input-group-text{
        border-radius:0 10px 10px 0;
    }

    .register-link{
        text-align:center;
        margin-top:20px;
    }

    .register-link a{
        color:#667eea;
        font-weight:bold;
    }

  </style>
</head>

<body class="hold-transition login-page">

<div class="login-box" data-aos="zoom-in">

    <div class="login-logo">
        <a href="/">
            <i class="fas fa-hand-holding-heart"></i>
            <b>DonasiKu</b>
        </a>
    </div>

    <div class="card shadow-lg">

        <div class="card-body login-card-body">

            <p class="login-box-msg">
                Login untuk mulai berdonasi ✨
            </p>

            <!-- ERROR -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- FORM LOGIN -->
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <!-- EMAIL -->
                <div class="input-group mb-3">

                    <input
                        type="email"
                        class="form-control"
                        name="email"
                        placeholder="Email"
                        required
                    >

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>

                </div>

                <!-- PASSWORD -->
                <div class="input-group mb-3">

                    <input
                        type="password"
                        class="form-control"
                        name="password"
                        placeholder="Password"
                        required
                    >

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>

                </div>

                <!-- REMEMBER -->
                <div class="icheck-primary mb-3">

                    <input type="checkbox" id="remember" name="remember">

                    <label for="remember">
                        Ingat Saya
                    </label>

                </div>

                <!-- BUTTON -->
                <button type="submit" class="btn btn-primary btn-block py-2">
                    <i class="fas fa-sign-in-alt"></i>
                    Login
                </button>

            </form>

            <!-- REGISTER -->
            <div class="register-link">

                Belum punya akun?

                <a href="{{ route('register') }}">
                    Daftar
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