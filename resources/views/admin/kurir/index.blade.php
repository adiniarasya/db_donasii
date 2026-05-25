@extends('template.layout')

@section('title', 'Manajemen Kurir')

@section('content')

<style>
    .gradient-header {
        background: linear-gradient(135deg, #0f172a, #2563eb);
        border-radius: 18px;
        color: white;
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.25);
    }

    .custom-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }

    .kurir-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .kurir-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }

    .avatar-circle {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #0f172a, #2563eb);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stat-box {
        text-align: center;
        padding: 10px;
        border-radius: 12px;
        background: #f8fafc;
    }

    .stat-number {
        font-size: 24px;
        font-weight: bold;
    }

    .btn-edit {
        background: linear-gradient(135deg, #d97706, #f59e0b);
        border: none;
        border-radius: 10px;
        color: white;
        padding: 8px 16px;
        font-size: 14px;
        transition: .3s;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #dc2626, #ef4444);
        border: none;
        border-radius: 10px;
        color: white;
        padding: 8px 16px;
        font-size: 14px;
        transition: .3s;
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        color: white;
    }

    .btn-create {
        background: linear-gradient(135deg, #0f172a, #2563eb);
        border: none;
        border-radius: 12px;
        padding: 10px 24px;
        transition: .3s;
    }

    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
    }

    .info-icon {
        width: 28px;
        color: #64748b;
    }
</style>

<div class="container-fluid">

    {{-- HEADER GRADIENT --}}
    <div class="gradient-header p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-1 font-weight-bold">
                    <i class="fas fa-truck mr-2"></i>
                    Manajemen Kurir
                </h3>
                <small>
                    <i class="fas fa-users mr-1"></i>
                    Kelola data kurir pengantar donasi
                </small>
            </div>
            <div>
                <a href="{{ route('admin.kurir.create') }}" class="btn btn-create text-white">
                    <i class="fas fa-plus-circle"></i> Tambah Kurir
                </a>
            </div>
        </div>
    </div>

    {{-- DATA KURIR --}}
    <div class="row">
        @forelse($kurirs as $kurir)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card kurir-card">
                <div class="card-body p-4">

                    {{-- PROFILE --}}
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3">
                            <div class="avatar-circle">
                                <i class="fas fa-user text-white fa-2x"></i>
                            </div>
                        </div>
                        <div>
                            <h4 class="mb-0" style="color: #0f172a;">{{ $kurir->name }}</h4>
                            <small class="text-muted">
                                <i class="fas fa-envelope"></i> {{ $kurir->email }}
                            </small>
                        </div>
                    </div>

                    <hr style="border-color: #e2e8f0;">

                    {{-- INFO KONTAK --}}
                    <p class="mb-2">
                        <i class="fas fa-phone info-icon"></i>
                        <strong>No. HP:</strong> {{ $kurir->kurirProfile->no_hp ?? '-' }}
                    </p>
                    <p class="mb-2">
                        <i class="fas fa-map-marker-alt info-icon"></i>
                        <strong>Alamat:</strong> {{ $kurir->kurirProfile->alamat ?? '-' }}
                    </p>
                    <p class="mb-3">
                        <i class="fas fa-calendar-alt info-icon"></i>
                        <strong>Bergabung:</strong> {{ $kurir->created_at->format('d/m/Y') }}
                    </p>

                    <hr style="border-color: #e2e8f0;">

                    {{-- STATISTIK --}}
                    <div class="row text-center mb-3 g-2">
                        <div class="col-6">
                            <div class="stat-box">
                                <div class="stat-number text-primary">{{ $kurir->total_tugas ?? 0 }}</div>
                                <small class="text-muted">Total Tugas</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-box">
                                <div class="stat-number text-success">{{ $kurir->selesai ?? 0 }}</div>
                                <small class="text-muted">Selesai</small>
                            </div>
                        </div>
                    </div>

                    {{-- ACTION BUTTONS --}}
                    <div class="row mt-3 g-2">
                        <div class="col-6 pe-1">
                            <a href="{{ route('admin.kurir.edit', $kurir->id) }}" class="btn btn-edit w-100">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                        <div class="col-6 ps-1">
                            <form action="{{ route('admin.kurir.destroy', $kurir->id) }}" method="POST">
                                {{ csrf_field() }}
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus kurir ini?')" class="btn btn-delete w-100">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @empty

        <div class="col-12">
            <div class="card custom-card">
                <div class="card-body text-center py-5">
                    <i class="fas fa-truck fa-5x mb-3" style="color: #cbd5e1;"></i>
                    <h3 style="color: #475569;">Belum Ada Kurir</h3>
                    <p class="text-muted mb-4">Silakan tambah kurir terlebih dahulu</p>
                    <a href="{{ route('admin.kurir.create') }}" class="btn btn-create text-white px-4">
                        <i class="fas fa-plus-circle"></i> Tambah Kurir
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</div>

@endsection