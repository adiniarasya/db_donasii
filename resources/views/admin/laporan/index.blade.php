@extends('template.layout')

@section('title', 'Laporan Donasi')

@section('content')

<style>
    .gradient-header {
    background: linear-gradient(135deg, #0f172a, #2563eb);
        border-radius: 18px;
        color: white;
        box-shadow: 0 8px 25px rgba(102,126,234,0.25);
    }

    .custom-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }

    .summary-card {
        border-radius: 20px;
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }

    .summary-title {
        font-size: 14px;
        color: #6c757d;
        font-weight: 600;
    }

    .summary-value {
        font-size: 32px;
        font-weight: bold;
    }

    .table-custom thead {
    background: linear-gradient(135deg, #0f172a, #2563eb);
        color: white;
    }

    .table-custom thead th {
        border: none;
        padding: 16px;
        font-size: 15px;
    }

    .table-custom tbody td {
        vertical-align: middle;
        padding: 18px;
    }

    .btn-detail {
    background: linear-gradient(135deg, #0f172a, #2563eb);
        border: none;
        border-radius: 10px;
        color: white;
        padding: 8px 16px;
        font-size: 14px;
        transition: .3s;
    }

    .btn-detail:hover {
        transform: translateY(-2px);
        color: white;
    }

    .chart-container {
        position: relative;
        height: 350px;
    }
</style>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="gradient-header p-4 mb-4">

        <h3 class="mb-1 font-weight-bold">
            <i class="fas fa-chart-line"></i>
            Laporan Donasi
        </h3>

        <small>
            Statistik dan laporan donasi terkini
        </small>

    </div>

    <div class="row">

        {{-- GRAFIK --}}
        <div class="col-lg-8 mb-4">

            <div class="card custom-card">

                <div class="card-body p-4">

                    <h5 class="font-weight-bold mb-4">
                        Grafik Donasi per Bulan
                    </h5>

                    <div class="chart-container">
                        <canvas id="donasiChart"></canvas>
                    </div>

                </div>
            </div>
        </div>


        {{-- RINGKASAN --}}
<div class="col-lg-4 mb-4">

    <div class="card summary-card">

        <div class="card-body p-4">

            <h5 class="font-weight-bold mb-4" style="color: #0f172a;">
                <i class="fas fa-chart-pie mr-2" style="color: #2563eb;"></i>
                Ringkasan Donasi
            </h5>

            <div class="mb-4" style="border-bottom: 1px solid rgba(37, 99, 235, 0.15); padding-bottom: 15px;">

                <div class="summary-title" style="font-size: 13px; color: #64748b; margin-bottom: 8px;">
                    <i class="fas fa-money-bill-wave" style="color: #2563eb; margin-right: 6px;"></i> 
                    Total Donasi Uang
                </div>

                <div class="summary-value" style="font-size: 30px; font-weight: bold; color: #1e40af;">
                    Rp {{ number_format($totalUang,0,',','.') }}
                </div>

            </div>

            <div class="mb-4" style="border-bottom: 1px solid rgba(37, 99, 235, 0.15); padding-bottom: 15px;">

                <div class="summary-title" style="font-size: 13px; color: #64748b; margin-bottom: 8px;">
                    <i class="fas fa-box" style="color: #3b82f6; margin-right: 6px;"></i> 
                    Total Donasi Barang
                </div>

                <div class="summary-value" style="font-size: 30px; font-weight: bold; color: #2563eb;">
                    {{ number_format($totalBarang,0,',','.') }} <span style="font-size: 14px; font-weight: normal;">Item</span>
                </div>

            </div>

            <div>

                <div class="summary-title" style="font-size: 13px; color: #64748b; margin-bottom: 8px;">
                    <i class="fas fa-users" style="color: #60a5fa; margin-right: 6px;"></i> 
                    Jumlah Donatur
                </div>

                <div class="summary-value" style="font-size: 30px; font-weight: bold; color: #3b82f6;">
                    {{ number_format($totalDonatur,0,',','.') }} <span style="font-size: 14px; font-weight: normal;">Orang</span>
                </div>

            </div>

        </div>

    </div>

</div>
    </div>

    {{-- TABEL --}}
    <div class="card custom-card">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover table-custom text-center">

                    <thead>
                        <tr>
                            <th>Periode</th>
                            <th>Total Donasi Uang</th>
                            <th>Total Donasi Barang</th>
                            <th>Jumlah Donatur</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($laporans as $laporan)

                        <tr>

                            <td>
                                {{ $laporan->periode }}
                            </td>

                            <td>
                                Rp {{ number_format($laporan->total_donasi_uang,0,',','.') }}
                            </td>

                            <td>
                                {{ $laporan->total_donasi_barang }}
                            </td>

                            <td>
                                {{ $laporan->jumlah_donatur }}
                            </td>

                            <td>
                                
                               <a href="{{ url('/admin/laporan/cetak-pdf/' . $laporan->periode) }}" 
                                class="btn btn-detail" 
                                target="_blank">
                                    <i class="fas fa-file-pdf"></i> Detail
                                </a>
                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="5" class="text-muted py-4">
                                Belum ada laporan donasi
                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('donasiChart');

new Chart(ctx, {
    type: 'bar',

    data: {
        labels: {!! json_encode($chartLabels) !!},

        datasets: [
            {
                label: 'Donasi Uang (Rp)',
                data: {!! json_encode($chartUang) !!},
                backgroundColor: '#2563eb',
                borderRadius: 10,
                yAxisID: 'y'
            },

            {
                label: 'Donasi Barang (Item)',
                data: {!! json_encode($chartBarang) !!},
               backgroundColor: '#0f172a',
                borderRadius: 10,
                yAxisID: 'y1'
            }
        ]
    },

    options: {

        responsive: true,
        maintainAspectRatio: false,

        plugins: {
            legend: {
                position: 'top',

                labels: {
                    font: {
                        size: 13
                    }
                }
            }
        },

        scales: {

            y: {
                beginAtZero: true,
                position: 'left',

                ticks: {
                    callback: function(value) {
                        return 'Rp ' + value;
                    }
                }
            },

            y1: {
                beginAtZero: true,
                position: 'right',

                grid: {
                    drawOnChartArea: false
                },

                ticks: {
                    callback: function(value) {
                        return value + ' item';
                    }
                }
            }
        }
    }
});

</script>

@endsection