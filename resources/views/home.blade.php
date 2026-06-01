<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>DonasiKu</title>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/bootstrap/css/bootstrap.min.css') }}">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>

        body{
            background: linear-gradient(135deg,#343a40,#007bff);
            min-height:100vh;
            overflow-x:hidden;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .navbar-custom{
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
        }

        .hero-title{
            font-size:60px;
            font-weight:bold;
            color:white;
            line-height:1.2;
        }

        .hero-text{
            color:rgba(255,255,255,0.8);
            font-size:20px;
        }

        .btn-custom{
            border-radius:12px;
            padding:12px 25px;
            font-weight:bold;
        }

        .card-custom{
            border:none;
            border-radius:20px;
            overflow:hidden;
            transition:0.3s;
        }

        .card-custom:hover{
            transform:translateY(-5px);
        }

        .section-title{
            color:white;
            font-weight:bold;
        }

        .text-soft{
            color:rgba(255,255,255,0.7);
        }

        footer{
            margin-top:80px;
            padding:20px;
            text-align:center;
            color:white;
        }

    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">

    <div class="container">

        <a class="navbar-brand font-weight-bold" href="/">
            <i class="fas fa-hand-holding-heart"></i>
            DonasiKu
        </a>

        <div>

            @guest

            <a href="{{ route('login') }}" class="btn btn-outline-light btn-custom mr-2"> Login </a>
            <a href="{{ route('register') }}" class="btn btn-light btn-custom"> Register </a>

            @else

            <a href="/donatur/dashboard" class="btn btn-light btn-custom"> Dashboard </a>

            @endguest

        </div>
    </div>
</nav>

<!-- HERO -->
<div class="container">

    <div class="row min-vh-100 align-items-center">
        <!-- TEXT -->
        <div class="col-lg-6" data-aos="fade-right">
            <h1 class="hero-title">
                Berbagi Berkah <br>
                Melalui Donasi
            </h1>

            <p class="hero-text mt-4">
                Platform donasi terpercaya untuk membantu sesama.
                Donasi uang maupun barang akan disalurkan
                kepada yang membutuhkan.
            </p>

            <div class="mt-4">

                @guest

                <a href="{{ route('register') }}" class="btn btn-light btn-lg btn-custom mr-2">
                    <i class="fas fa-user-plus"></i> Daftar Sekarang
                </a>

                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg btn-custom">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>

                @else

                <a href="/donatur/dashboard" class="btn btn-light btn-lg btn-custom"> Dashboard </a>

                @endguest
            </div>
        </div>

        <!-- IMAGE -->
        <div class="col-lg-6 text-center" data-aos="fade-left">
            <img src="https://cdn-icons-png.flaticon.com/512/2544/2544086.png" class="img-fluid" style="max-width:80%;">
        </div>
    </div>
</div>

<!-- STATISTIK -->
<div class="container mb-5">
    <div class="row">
        <!-- TOTAL DONASI UANG -->
        <div class="col-md-4 mb-4" data-aos="fade-up">
            <div class="card card-custom shadow">
                <div class="card-body text-center p-5">
                    <i class="fas fa-money-bill-wave fa-3x text-primary mb-3"></i>
                    <h2>
                        Rp {{ number_format($totalDonasiUang,0,',','.') }}
                    </h2>

                    <p class="text-muted">
                        Total Donasi Uang
                    </p>
                </div>
            </div>
        </div>

        <!-- TOTAL BARANG -->
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card card-custom shadow">
                <div class="card-body text-center p-5">
                    <i class="fas fa-box fa-3x text-success mb-3"></i>
                    <h2>
                        {{ $totalDonasiBarang }} Item
                    </h2>

                    <p class="text-muted">
                        Total Donasi Barang
                    </p>
                </div>
            </div>
        </div>

        <!-- TOTAL DONATUR -->
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="400">
            <div class="card card-custom shadow">
                <div class="card-body text-center p-5">
                    <i class="fas fa-users fa-3x text-info mb-3"></i>
                    <h2>
                        {{ $totalDonatur }} Orang
                    </h2>

                    <p class="text-muted">
                        Donatur Peduli
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DONASI TERBARU -->
<div class="container mb-5">
    <div class="text-center mb-5">
        <h2 class="section-title">
            Donasi Terbaru
        </h2>

        <p class="text-soft">
            Terima kasih untuk para donatur ❤️
        </p>
    </div>

    <div class="row">
        @foreach($recentDonasi as $donasi)
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
            <div class="card card-custom shadow h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-user-circle fa-2x text-primary mr-3"></i>
                        <div>
                            <h6 class="mb-0">
                                {{ $donasi->user->name }}
                            </h6>

                            <small class="text-muted">
                                {{ $donasi->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>

                    <p>
                        @if($donasi->jenis_donasi == 'uang')
                            <i class="fas fa-money-bill-wave text-primary"></i> Donasi uang sebesar
                            <strong>
                                Rp {{ number_format($donasi->nominal,0,',','.') }}
                            </strong>
                        @else
                            <i class="fas fa-box text-success"></i> Donasi
                            <strong>
                                {{ $donasi->nama_barang }}
                            </strong>
                            ({{ $donasi->jumlah_barang }} pcs)
                        @endif
                    </p>

                    @if($donasi->deskripsi)
                    <p class="text-muted small">
                        "{{ $donasi->deskripsi }}"
                    </p>
                    @endif

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- FOOTER -->
<footer>
    © 2026 DonasiKu - Platform Donasi Terpercaya
</footer>

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