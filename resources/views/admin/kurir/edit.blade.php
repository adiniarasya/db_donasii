@extends('template.layout')

@section('title', 'Edit Kurir')

@section('content')

<style>
    .gradient-header {
        background: linear-gradient(135deg, #0f172a, #2563eb);
        border-radius: 18px;
        color: white;
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.25);
    }

    .form-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }

    .btn-update {
        background: linear-gradient(135deg, #0f172a, #2563eb);
        border: none;
        border-radius: 12px;
        padding: 12px;
        font-weight: 600;
        transition: .3s;
    }

    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
    }

    .btn-back {
        border-radius: 12px;
        padding: 12px;
        font-weight: 600;
        border: 1px solid #cbd5e1;
        transition: .3s;
    }

    .btn-back:hover {
        background: #f1f5f9;
        transform: translateY(-2px);
    }

    .form-label {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .form-control {
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        padding: 12px;
        transition: .3s;
    }

    .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .alert-custom {
        border-radius: 12px;
        border-left: 4px solid #dc2626;
    }
</style>

<div class="container-fluid">

    {{-- HEADER GRADIENT --}}
    <div class="gradient-header p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-1 font-weight-bold">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Kurir
                </h3>
                <small>
                    <i class="fas fa-truck mr-1"></i>
                    Ubah data kurir {{ $kurir->name }}
                </small>
            </div>
        </div>
    </div>

    {{-- FORM --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card form-card">
                <div class="card-body p-4">

                    @if ($errors->any())
                        <div class="alert alert-danger alert-custom mb-4">
                            <strong><i class="fas fa-exclamation-triangle"></i> Terjadi Kesalahan!</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.kurir.update', $kurir->id) }}" method="POST">
                        {{ csrf_field() }}
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label">
                                <i class="fas fa-user text-primary mr-1"></i> Nama Lengkap
                            </label>
                            <input type="text" name="name" class="form-control" value="{{ $kurir->name }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                <i class="fas fa-envelope text-primary mr-1"></i> Email
                            </label>
                            <input type="email" name="email" class="form-control" value="{{ $kurir->email }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                <i class="fas fa-lock text-primary mr-1"></i> Password
                            </label>
                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
                            <small class="text-muted">Minimal 8 karakter, kosongkan jika tidak ingin mengubah password</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                <i class="fas fa-phone text-primary mr-1"></i> Nomor HP
                            </label>
                            <input type="text" name="no_hp" class="form-control" value="{{ $kurir->no_hp }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                <i class="fas fa-map-marker-alt text-primary mr-1"></i> Alamat
                            </label>
                            <textarea name="alamat" rows="4" class="form-control" required>{{ $kurir->alamat }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-update text-white w-100 mb-3">
                            <i class="fas fa-save"></i> Update Kurir
                        </button>

                        <a href="{{ route('admin.kurir.index') }}" class="btn btn-back w-100 text-center">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection