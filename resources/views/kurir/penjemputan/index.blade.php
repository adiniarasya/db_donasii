<div class="container mt-4">

    <h2>Dashboard Kurir</h2>

    <p>Selamat datang, {{ auth()->user()->name }}</p>

    <hr>

    <h4>Statistik</h4>

    <p>Total Tugas :
        {{ auth()->user()->penjemputan->count() }}
    </p>

    <p>Tugas Aktif :
        {{ auth()->user()->penjemputan->where('status', '!=', 'selesai')->count() }}
    </p>

    <p>Tugas Selesai :
        {{ auth()->user()->penjemputan->where('status', 'selesai')->count() }}
    </p>

    <hr>

    <h4>Daftar Penjemputan</h4>

    @forelse(auth()->user()->penjemputan as $penjemputan)

        <div class="card mb-3">
            <div class="card-body">

                <p>
                    <strong>Donatur :</strong>
                    {{ $penjemputan->donasi->user->name }}
                </p>

                <p>
                    <strong>Barang :</strong>
                    {{ $penjemputan->donasi->nama_barang }}
                </p>

                <p>
                    <strong>Jumlah :</strong>
                    {{ $penjemputan->donasi->jumlah_barang }} pcs
                </p>

                <p>
                    <strong>Alamat :</strong>
                    {{ $penjemputan->alamat_jemput }}
                </p>

                <p>
                    <strong>Tanggal Jemput :</strong>
                    {{ $penjemputan->tanggal_jemput->format('d/m/Y') }}
                </p>

                <p>
                    <strong>Status :</strong>
                    {{ $penjemputan->status }}
                </p>

                @if($penjemputan->status != 'selesai')

                    <form action="{{ route('kurir.penjemputan.update', $penjemputan->id) }}" method="POST">

                        @csrf

                        <button type="submit" class="btn btn-primary">

                            @if($penjemputan->status == 'menunggu')

                                Proses

                            @elseif($penjemputan->status == 'diproses')

                                Menuju

                            @elseif($penjemputan->status == 'menuju')

                                Selesai

                            @endif

                        </button>

                    </form>

                @endif

            </div>
        </div>

    @empty

        <p>Belum ada tugas penjemputan.</p>

    @endforelse

</div>