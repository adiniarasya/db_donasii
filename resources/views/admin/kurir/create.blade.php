@extends('template.layout')
@section('title', 'Tambah Kurir')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header">
                    <h3 class="mb-0">
                        <i class="fas fa-plus-circle"></i> Tambah Kurir
                    </h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.kurir.store') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                            <small class="text-muted"> Minimal 8 karakter </small>
                        </div>

                        <div class="mb-3">
                            <label>Nomor HP</label>
                            <input type="text" name="no_hp" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Alamat</label>
                            <textarea name="alamat" rows="4" class="form-control" required></textarea>
                        </div>

                        <input type="hidden" name="role" value="kurir">

                        <button type="submit" class="btn btn-primary w-100 mb-2">
                            <i class="fas fa-save"></i> Simpan Kurir
                        </button>

                        <a href="{{ route('admin.kurir.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection