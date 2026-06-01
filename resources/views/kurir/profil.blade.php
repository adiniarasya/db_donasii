@extends('template.layout')
@section('title', 'Profil Kurir')
@section('content')

<div class="container-fluid">
    <div class="card shadow-lg border-0 mt-3" style="border-radius: 15px; overflow: hidden;">
        <div class="card-header" style="background: linear-gradient(135deg, #0f172a, #2563eb); border-bottom: none;">
            <h4 class="mb-0 text-white">
                <i class="fas fa-user-circle mr-2"></i>
                Lengkapi Profil Kurir
            </h4>
            <p class="text-white-50 mb-0 small mt-1">
                <i class="fas fa-info-circle mr-1"></i> Isi data diri Anda untuk mulai bertugas
            </p>
        </div>

        <div class="card-body" style="background: linear-gradient(135deg, #f0f9ff, #e0f2fe);">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" style="background: linear-gradient(135deg, #d1fae5, #a7f3d0); color: #065f46; border-left: 4px solid #059669; border-radius: 10px;">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" style="background: linear-gradient(135deg, #fee2e2, #fecaca); color: #991b1b; border-left: 4px solid #dc2626; border-radius: 10px;">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <strong>Error!</strong> Silakan periksa kembali form Anda.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{ route('kurir.profil.update') }}" method="POST">
                {{ csrf_field() }}
                
                <div class="form-group mb-4">
                    <label style="color: #1e3a8a; font-weight: 600; margin-bottom: 8px;">
                        <i class="fas fa-user mr-1"></i> Nama
                    </label>
                    <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px; font-weight: 500;">
                </div>

                <div class="form-group mb-4">
                    <label style="color: #1e3a8a; font-weight: 600; margin-bottom: 8px;">
                        <i class="fas fa-envelope mr-1"></i> Email
                    </label>
                    <input type="text" class="form-control" value="{{ auth()->user()->email }}" readonly style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px; font-weight: 500;">
                </div>

                <div class="form-group mb-4">
                    <label style="color: #1e3a8a; font-weight: 600; margin-bottom: 8px;">
                        <i class="fas fa-phone-alt mr-1"></i> No HP <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="no_hp" class="form-control" value="{{ auth()->user()->kurirProfile->no_hp ?? '' }}" required style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px; transition: all 0.3s ease;" onfocus="this.style.borderColor='#2563eb'; this.style.boxShadow='0 0 0 3px rgba(37,99,235,0.1)';"
 onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';">
                    <small class="text-muted mt-1 d-block">
                        <i class="fas fa-info-circle mr-1" style="color: #2563eb;"></i>
                        Gunakan nomor WhatsApp aktif untuk koordinasi
                    </small>
                </div>

                <div class="form-group mb-4">
                    <label style="color: #1e3a8a; font-weight: 600; margin-bottom: 8px;">
                        <i class="fas fa-map-marker-alt mr-1"></i> Alamat <span class="text-danger">*</span>
                    </label>
                    <textarea name="alamat" class="form-control" rows="3" required style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px; resize: vertical; transition: all 0.3s ease;" onfocus="this.style.borderColor='#2563eb'; this.style.boxShadow='0 0 0 3px rgba(37,99,235,0.1)';" onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';">{{ auth()->user()->kurirProfile->alamat ?? '' }}</textarea>
                </div>

                <hr style="border-top: 2px dotted #93c5fd; margin: 20px 0;">

                <div class="text-right">
                    <a href="{{ route('kurir.penjemputan') }}" class="btn px-4 py-2 mr-2"  style="background: #64748b; border: none; border-radius: 10px; color: white; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.background='#475569'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='#64748b'; this.style.transform='translateY(0)';">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                    <button type="submit" class="btn px-5 py-2" style="background: linear-gradient(135deg, #2563eb, #1e40af); border: none; border-radius: 10px; color: white; font-weight: 600; box-shadow: 0 4px 10px rgba(37,99,235,0.3); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 15px rgba(37,99,235,0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 10px rgba(37,99,235,0.3)';">
                        <i class="fas fa-save mr-2"></i> Simpan Profil
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection