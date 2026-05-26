@extends('template.layout')

@section('title', 'Form Donasi')

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

    .form-header {
        background: linear-gradient(135deg, #0f172a, #2563eb);
        color: white;
        padding: 20px 24px;
        border: none;
    }

    .form-header h4 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
    }

    .form-header p {
        margin: 5px 0 0 0;
        font-size: 13px;
        opacity: 0.9;
    }

    .form-body {
        padding: 30px;
    }

    .form-label {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control-custom {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 14px;
        transition: all 0.3s ease;
        width: 100%;
    }

    .form-control-custom:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        outline: none;
    }

    select.form-control-custom {
        cursor: pointer;
        background-color: white;
    }

    textarea.form-control-custom {
        resize: vertical;
        min-height: 100px;
    }

    .radio-group {
        display: flex;
        gap: 24px;
        padding: 12px 0;
    }

    .radio-option {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        padding: 8px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 30px;
        transition: all 0.3s ease;
    }

    .radio-option:hover {
        border-color: #2563eb;
        background: #f8f9ff;
    }

    .radio-option input[type="radio"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #2563eb;
    }

    .radio-option label {
        margin: 0;
        cursor: pointer;
        font-weight: 500;
        color: #1e293b;
    }

    .radio-option.has-checked {
        border-color: #2563eb;
        background: linear-gradient(135deg, #eff6ff, #f8f9ff);
    }

    .btn-submit {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border: none;
        border-radius: 12px;
        padding: 12px 28px;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: white;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        width: 100%;
        justify-content: center;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        background: linear-gradient(135deg, #1d4ed8, #2563eb);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
    }

    .info-text {
        font-size: 12px;
        color: #64748b;
        margin-top: 5px;
    }

    .required-star {
        color: #ef4444;
        margin-left: 4px;
    }
</style>

<div class="container-fluid">

    {{-- HEADER GRADIENT --}}
    <div class="gradient-header p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-1 font-weight-bold">
                    <i class="fas fa-hand-holding-heart mr-2"></i>
                    Form Donasi
                </h3>
                <small>
                    <i class="fas fa-heart mr-1"></i>
                    Isi data donasi Anda dengan lengkap
                </small>
            </div>
            <div>
                <span class="badge bg-white text-dark px-3 py-2">
                    <i class="fas fa-calendar-alt"></i> {{ date('d F Y') }}
                </span>
            </div>
        </div>
    </div>

    {{-- FORM DONASI --}}
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="form-card">
                <div class="form-header">
                    <h4>
                        <i class="fas fa-edit mr-2"></i>
                        Formulir Donasi
                    </h4>
                    <p>Lengkapi data berikut untuk melakukan donasi</p>
                </div>

                <div class="form-body">
                    <form action="{{ route('donatur.donasi.store') }}" method="POST">
                        @csrf

                        {{-- Jenis Donasi --}}
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="fas fa-tag mr-1"></i>
                                Jenis Donasi
                                <span class="required-star">*</span>
                            </label>
                            <div class="radio-group" id="radioGroup">
                                <div class="radio-option" onclick="selectRadio(this, 'uang')">
                                    <input type="radio" name="jenis_donasi" value="uang" checked onchange="toggleForm()">
                                    <label><i class="fas fa-money-bill-wave"></i> Donasi Uang</label>
                                </div>
                                <div class="radio-option" onclick="selectRadio(this, 'barang')">
                                    <input type="radio" name="jenis_donasi" value="barang" onchange="toggleForm()">
                                    <label><i class="fas fa-box"></i> Donasi Barang</label>
                                </div>
                            </div>
                        </div>

                        {{-- FORM UANG --}}
                        <div id="form-uang">
                            <div class="mb-4">
                                <label class="form-label">
                                    <i class="fas fa-coins mr-1"></i>
                                    Nominal Donasi
                                    <span class="required-star">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background: #f1f5f9; border-radius: 12px 0 0 12px; border: 1px solid #e2e8f0;">
                                        <i class="fas fa-rupiah-sign"></i> Rp
                                    </span>
                                    <input type="number"
                                           name="nominal"
                                           class="form-control-custom"
                                           style="border-radius: 0 12px 12px 0;"
                                           placeholder="Masukkan nominal donasi"
                                           min="1000"
                                           step="1000">
                                </div>
                                <div class="info-text">
                                    <i class="fas fa-info-circle"></i> Minimal donasi Rp 1.000
                                </div>
                            </div>
                        </div>

                        {{-- FORM BARANG --}}
                        <div id="form-barang" style="display:none;">
                            <div class="mb-4">
                                <label class="form-label">
                                    <i class="fas fa-box-open mr-1"></i>
                                    Nama Barang
                                    <span class="required-star">*</span>
                                </label>
                                <input type="text"
                                       name="nama_barang"
                                       class="form-control-custom"
                                       placeholder="Masukkan nama barang">
                            </div>

                            <div class="mb-4">
                                <label class="form-label">
                                    <i class="fas fa-hashtag mr-1"></i>
                                    Jumlah Barang
                                    <span class="required-star">*</span>
                                </label>
                                <input type="number"
                                       name="jumlah_barang"
                                       class="form-control-custom"
                                       placeholder="Jumlah barang"
                                       min="1">
                                <div class="info-text">
                                    <i class="fas fa-info-circle"></i> Masukkan jumlah barang dalam satuan (pcs)
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">
                                    <i class="fas fa-clipboard-list mr-1"></i>
                                    Kondisi Barang
                                    <span class="required-star">*</span>
                                </label>
                                <select name="kondisi" class="form-control-custom">
                                    <option value="baru">✨ Baru</option>
                                    <option value="bekas">📦 Bekas - Layak Pakai</option>
                                    <option value="rusak">⚠️ Rusak (Perbaikan)</option>
                                </select>
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="fas fa-file-alt mr-1"></i>
                                Deskripsi
                            </label>
                            <textarea name="deskripsi"
                                      class="form-control-custom"
                                      rows="4"
                                      placeholder="Tambahkan keterangan tambahan (opsional)"></textarea>
                        </div>

                        {{-- Tanggal Donasi --}}
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="fas fa-calendar-day mr-1"></i>
                                Tanggal Donasi
                                <span class="required-star">*</span>
                            </label>
                            <input type="date"
                                   name="tanggal"
                                   class="form-control-custom"
                                   value="{{ date('Y-m-d') }}">
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-paper-plane"></i>
                            Kirim Donasi
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleForm()
    {
        let jenis = document.querySelector('input[name="jenis_donasi"]:checked').value;

        if(jenis == 'uang')
        {
            document.getElementById('form-uang').style.display = 'block';
            document.getElementById('form-barang').style.display = 'none';
        }
        else
        {
            document.getElementById('form-uang').style.display = 'none';
            document.getElementById('form-barang').style.display = 'block';
        }
    }

    function selectRadio(divElement, value) {
        let radio = divElement.querySelector('input[type="radio"]');
        radio.checked = true;
        
        // Update styling
        document.querySelectorAll('.radio-option').forEach(opt => {
            opt.classList.remove('has-checked');
        });
        divElement.classList.add('has-checked');
        
        toggleForm();
    }

    // Set initial checked styling
    document.addEventListener('DOMContentLoaded', function() {
        let checkedRadio = document.querySelector('input[name="jenis_donasi"]:checked');
        if (checkedRadio) {
            let parentDiv = checkedRadio.closest('.radio-option');
            if (parentDiv) {
                parentDiv.classList.add('has-checked');
            }
        }
    });
</script>

@endsection