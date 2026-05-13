<div class="container mt-4">

    <h2>Riwayat Donasi Saya</h2>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Detail</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>

            @foreach($donasis as $donasi)

            <tr>

                <td>{{ $donasi->id }}</td>

                <td>
                    {{ $donasi->tanggal->format('d/m/Y') }}
                </td>

                <td>

                    @if($donasi->jenis_donasi == 'uang')

                        Uang

                    @else

                        Barang

                    @endif

                </td>

                <td>

                    @if($donasi->jenis_donasi == 'uang')

                        Rp {{ number_format($donasi->nominal, 0, ',', '.') }}

                    @else

                        {{ $donasi->nama_barang }}

                        <br>

                        {{ $donasi->jumlah_barang }} pcs

                    @endif

                    @if($donasi->deskripsi)

                        <br>

                        <small>{{ $donasi->deskripsi }}</small>

                    @endif

                </td>

                <td>
                    {{ $donasi->status }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    {{ $donasis->links() }}

</div>