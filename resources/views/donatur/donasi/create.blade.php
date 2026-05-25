<div class="container mt-4">

    <h2>Form Donasi</h2>

    <form action="{{ route('donatur.donasi.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Jenis Donasi</label>
            <br>

            <input type="radio" name="jenis_donasi" value="uang" checked onclick="toggleForm()">
            Donasi Uang

            <input type="radio" name="jenis_donasi" value="barang" onclick="toggleForm()">
            Donasi Barang
        </div>

        {{-- FORM UANG --}}
        <div id="form-uang">

            <div class="mb-3">
                <label>Nominal</label>

                <input type="number"
                       name="nominal"
                       class="form-control"
                       placeholder="Masukkan nominal">
            </div>

        </div>

        {{-- FORM BARANG --}}
        <div id="form-barang" style="display:none;">

            <div class="mb-3">
                <label>Nama Barang</label>

                <input type="text"
                       name="nama_barang"
                       class="form-control"
                       placeholder="Masukkan nama barang">
            </div>

            <div class="mb-3">
                <label>Jumlah Barang</label>

                <input type="number"
                       name="jumlah_barang"
                       class="form-control"
                       placeholder="Jumlah barang">
            </div>

            <div class="mb-3">
                <label>Kondisi</label>

                <select name="kondisi" class="form-control">
                    <option value="baru">Baru</option>
                    <option value="bekas">Bekas</option>
                    <option value="rusak">Rusak</option>
                </select>
            </div>

        </div>

        <div class="mb-3">
            <label>Deskripsi</label>

            <textarea name="deskripsi"
                      class="form-control"
                      rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label>Tanggal Donasi</label>

            <input type="date"
                   name="tanggal"
                   class="form-control"
                   value="{{ date('Y-m-d') }}">
        </div>

        <button type="submit" class="btn btn-primary">
            Kirim Donasi
        </button>

    </form>

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

</script>