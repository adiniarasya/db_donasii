@extends('template.layout')
@section('title', 'Manajemen Kurir')
@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">
                        <i class="fas fa-truck"></i> Manajemen Kurir
                    </h3>
                    <a href="{{ route('admin.kurir.create') }}" class="btn btn-primary px-4">
                        <i class="fas fa-plus-circle"></i> Tambah Kurir
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- DATA KURIR --}}
    <div class="row">
        @forelse($kurirs as $kurir)
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    {{-- PROFILE --}}
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3">
                            <div class="bg-primary rounded-circle d-flex justify-content-center align-items-center" style="width:70px; height:70px;">
                                <i class="fas fa-user text-white fa-2x"></i>
                            </div>
                        </div>
                        <div>
                            <h4 class="mb-0">{{ $kurir->name }}</h4>
                            <small class="text-muted"> {{ $kurir->email }} </small>
                        </div>
                    </div>
                    <hr>

                    {{-- INFO --}}
                    <p class="mb-2">
                        <i class="fas fa-phone text-secondary"></i>
                        {{ $kurir->kurirProfile->no_hp ?? '-' }}
                    </p>
                    <p class="mb-2">
                        <i class="fas fa-map-marker-alt text-secondary"></i>
                        {{ $kurir->kurirProfile->alamat ?? '-' }}
                    </p>
                    <p class="mb-3">
                        <i class="fas fa-calendar text-secondary"></i>
                        Bergabung:
                        {{ $kurir->created_at->format('d/m/Y') }}
                    </p>
                    <hr>

                    {{-- STATISTIK --}}
                    <div class="row text-center mb-3">
                        <div class="col-6">
                            <h3 class="text-primary"> {{ $kurir->total_tugas ?? 0 }} </h3>
                            <small class="text-muted"> Total Tugas </small>
                        </div>
                        <div class="col-6">
                            <h3 class="text-success"> {{ $kurir->selesai ?? 0 }} </h3>
                            <small class="text-muted"> Selesai </small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 pe-1">
                            <a href="{{ route('admin.kurir.edit', $kurir->id) }}" class="btn btn-warning w-100">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                        <div class="col-6 ps-1">
                            <form action="{{ route('admin.kurir.destroy', $kurir->id) }}" method="POST">
                                {{ csrf_field() }}
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus kurir ini?')" class="btn btn-danger w-100">
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
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="fas fa-truck fa-5x text-secondary mb-3"></i>
                    <h2>Belum Ada Kurir</h2>
                    <p class="text-muted">
                        Silakan tambah kurir terlebih dahulu
                    </p>
                    <a href="{{ route('admin.kurir.create') }}" class="btn btn-primary px-4">
                        <i class="fas fa-plus-circle"></i> Tambah Kurir
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection