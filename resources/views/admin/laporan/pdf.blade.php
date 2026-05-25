<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Donasi - {{ $laporan->periode }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', 'Helvetica', sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
            padding: 20px;
        }
        
        /* Header */
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #2563eb;
        }
        
        .header h1 {
            color: #1e40af;
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .header h2 {
            color: #2563eb;
            font-size: 18px;
            margin-bottom: 10px;
        }
        
        .header p {
            color: #64748b;
            font-size: 12px;
        }
        
        /* Section Title */
        .section-title {
            background: linear-gradient(135deg, #0f172a, #2563eb);
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            margin: 20px 0 15px 0;
            font-size: 14px;
        }
        
        /* Info Box */
        .info-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .info-row {
            display: flex;
            padding: 8px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .info-row:last-child {
            border-bottom: none;
        }
        
        .info-label {
            width: 40%;
            font-weight: bold;
            color: #475569;
        }
        
        .info-value {
            width: 60%;
            color: #1e293b;
        }
        
        /* Summary Cards */
        .summary-grid {
            display: flex;
            gap: 15px;
            margin: 20px 0;
        }
        
        .summary-card {
            flex: 1;
            background: #f1f5f9;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            border: 1px solid #e2e8f0;
        }
        
        .summary-card h4 {
            font-size: 11px;
            color: #64748b;
            margin-bottom: 8px;
        }
        
        .summary-card .value {
            font-size: 18px;
            font-weight: bold;
            color: #1e40af;
        }
        
        /* Tabel Detail */
        .table-detail {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        
        .table-detail th {
            background: #0f172a;
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 11px;
        }
        
        .table-detail td {
            border: 1px solid #e2e8f0;
            padding: 8px 10px;
            font-size: 11px;
        }
        
        .table-detail tr:nth-child(even) {
            background: #f8fafc;
        }
        
        /* Footer */
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            font-size: 10px;
            color: #94a3b8;
        }
        
        /* Tanda Tangan */
        .signature {
            margin-top: 40px;
            display: flex;
            justify-content: flex-end;
        }
        
        .signature-box {
            text-align: center;
            width: 250px;
        }
        
        .signature-line {
            margin-top: 40px;
            padding-top: 10px;
            border-top: 1px solid #333;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-primary {
            color: #2563eb;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <h1>📊 LAPORAN DONASI</h1>
        <h2>DonasiKu</h2>
        <p>Jl. Donasi No. 123, Kota Contoh, Indonesia</p>
        <p>Email: info@donasiku.com | Telp: (021) 1234-5678</p>
    </div>

    <!-- JUDUL LAPORAN -->
    <div class="text-center" style="margin-bottom: 20px;">
        <h3 style="color: #0f172a;">LAPORAN PERIODE: {{ $laporan->periode }}</h3>
        <p style="color: #64748b;">Dicetak: {{ date('d F Y H:i:s') }}</p>
    </div>

    <!-- RINGKASAN KESELURUHAN -->
    <div class="summary-grid">
        <div class="summary-card">
            <h4>💰 Total Donasi Uang</h4>
            <div class="value">Rp {{ number_format($totalUang, 0, ',', '.') }}</div>
        </div>
        <div class="summary-card">
            <h4>📦 Total Donasi Barang</h4>
            <div class="value">{{ number_format($totalBarang, 0, ',', '.') }} Item</div>
        </div>
        <div class="summary-card">
            <h4>👥 Jumlah Donatur</h4>
            <div class="value">{{ number_format($totalDonatur, 0, ',', '.') }} Orang</div>
        </div>
    </div>

    <!-- DETAIL LAPORAN -->
    <div class="section-title">
        📋 Detail Laporan Donasi Periode {{ $laporan->periode }}
    </div>

    <div class="info-box">
        <div class="info-row">
            <div class="info-label">Periode Laporan</div>
            <div class="info-value">{{ $laporan->periode }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Total Donasi Uang</div>
            <div class="info-value">
                <strong class="text-primary">Rp {{ number_format($laporan->total_donasi_uang, 0, ',', '.') }}</strong>
            </div>
        </div>
        <div class="info-row">
            <div class="info-label">Total Donasi Barang</div>
            <div class="info-value">
                <strong class="text-primary">{{ number_format($laporan->total_donasi_barang, 0, ',', '.') }} Item</strong>
            </div>
        </div>
        <div class="info-row">
            <div class="info-label">Jumlah Donatur Aktif</div>
            <div class="info-value">
                <strong class="text-primary">{{ number_format($laporan->jumlah_donatur, 0, ',', '.') }} Orang</strong>
            </div>
        </div>
    </div>

    <!-- TABEL RINCIAN DONASI (jika ada) -->
    @if(isset($detailDonasi) && count($detailDonasi) > 0)
    <div class="section-title">
        📝 Rincian Donasi Bulan {{ $laporan->periode }}
    </div>
    
    <table class="table-detail">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Donatur</th>
                <th>Jenis Donasi</th>
                <th>Jumlah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detailDonasi as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ date('d/m/Y', strtotime($item->tanggal)) }}</td>
                <td>{{ $item->user->name ?? 'Anonim' }}</td>
                <td>{{ ucfirst($item->jenis_donasi) }}</td>
                <td>
                    @if($item->jenis_donasi == 'uang')
                        Rp {{ number_format($item->nominal, 0, ',', '.') }}
                    @else
                        {{ $item->jumlah_barang }} Item
                    @endif
                </td>
                <td><span style="background: #10b981; color: white; padding: 2px 8px; border-radius: 12px;">Selesai</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- KETERANGAN -->
    <div style="margin-top: 20px; padding: 10px; background: #fef3c7; border-radius: 8px;">
        <p style="font-size: 10px; color: #92400e;">
            <strong>📌 Keterangan:</strong> Laporan ini dibuat secara otomatis oleh sistem DonasiKu. 
            Data yang tercantum adalah akumulasi dari seluruh transaksi donasi pada periode yang dipilih.
        </p>
    </div>

    <!-- TANDA TANGAN -->
    <div class="signature">
        <div class="signature-box">
            <div class="signature-line"></div>
            <p style="font-size: 11px; margin-top: 5px;">( {{ date('d F Y') }} )</p>
            <p style="font-size: 11px; font-weight: bold;">Admin DonasiKu</p>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <p>Dokumen ini sah dan valid | Laporan DonasiKu | Sistem Informasi Donasi Online</p>
    </div>

</body>
</html>