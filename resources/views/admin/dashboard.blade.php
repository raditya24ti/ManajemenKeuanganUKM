@extends('layouts.app')
@section('title','Dashboard Keuangan UKM')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER (Tanpa Tombol Tambah agar Dashboard Bersih & Fokus pada Data) --}}
    <div class="mb-4">
        <h2 class="text-white fw-bold mb-1">Dashboard Keuangan UKM</h2>
        <p class="text-secondary mb-0">Laporan ringkas arus kas dan penyerapan anggaran organisasi.</p>
    </div>

    {{-- SUMMARY CARDS TEMA BIRU (Disesuaikan dengan Warna Logout) --}}
    <div class="row g-3 mb-4">
        @foreach([
            ['Pemasukan Kas', 'primary', $totalMasuk, 'fa-arrow-trend-up'],
            ['Pengeluaran Kas', 'info', $totalKeluar, 'fa-arrow-trend-down'],
            ['Saldo UKM', 'primary', $saldo, 'fa-wallet'],
            ['Total Anggaran', 'primary', $totalAnggaran, 'fa-chart-pie']
        ] as [$label, $color, $value, $icon])
        <div class="col-md-3">
            <div class="card h-100 bg-dark border-primary border-opacity-10 shadow-sm">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <small class="text-secondary text-uppercase fw-semibold small">{{ $label }}</small>
                        <div class="rounded-circle bg-primary bg-opacity-10 p-2">
                            <i class="fas {{ $icon }} text-primary"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold text-white mb-0">
                        Rp {{ number_format($value, 0, ',', '.') }}
                    </h4>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- GRAFIK & STATUS ANGGARAN --}}
    <div class="row g-3 mb-4">
        {{-- GRAFIK TREN BULANAN --}}
        <div class="col-lg-8">
            <div class="card bg-dark border-primary border-opacity-10 h-100 shadow-sm">
                <div class="card-header bg-transparent border-primary border-opacity-10 py-3 text-white fw-bold">
                    <i class="fas fa-chart-line me-2 text-primary"></i>Tren Arus Kas Bulanan
                </div>
                <div class="card-body">
                    <canvas id="monthlyChart" height="150"></canvas>
                </div>
            </div>
        </div>

        {{-- STATUS PENYERAPAN ANGGARAN --}}
        <div class="col-lg-4">
            <div class="card bg-dark border-primary border-opacity-10 h-100 shadow-sm">
                <div class="card-header bg-transparent border-primary border-opacity-10 py-3 text-white fw-bold">
                    <i class="fas fa-bullseye me-2 text-info"></i>Penyerapan Anggaran
                </div>
                <div class="card-body text-center d-flex flex-column justify-content-center">
                    <h1 class="fw-bold mb-0 text-primary">{{ round($persenAnggaran) }}%</h1>
                    <p class="text-secondary small mb-3">Anggaran Telah Digunakan</p>
                    <div class="progress mb-3" style="height:12px; background-color: #1a1a1a;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary shadow-sm" 
                             style="width: {{ min($persenAnggaran,100) }}%"></div>
                    </div>
                    <div class="d-flex justify-content-between small text-white-50">
                        <span>Limit: Rp {{ number_format($totalAnggaran, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        {{-- RINGKASAN PENGELUARAN PER KATEGORI --}}
        <div class="col-md-5">
            <div class="card bg-dark border-primary border-opacity-10 h-100 shadow-sm">
                <div class="card-header bg-transparent border-primary border-opacity-10 py-3 text-white fw-bold">
                    <i class="fas fa-tags me-2 text-info"></i>Pengeluaran per Kategori
                </div>
                <ul class="list-group list-group-flush bg-transparent">
                    @forelse($kategori as $k)
                    <li class="list-group-item bg-transparent border-primary border-opacity-10 d-flex justify-content-between align-items-center text-white-50 py-3">
                        {{ $k->kategori }}
                        <span class="fw-bold text-white">
                            Rp {{ number_format($k->total, 0, ',', '.') }}
                        </span>
                    </li>
                    @empty
                    <li class="list-group-item bg-transparent text-center py-5 text-secondary small">
                        Belum ada data pengeluaran UKM.
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- DAFTAR TRANSAKSI TERBARU --}}
        <div class="col-md-7">
            <div class="card bg-dark border-primary border-opacity-10 h-100 shadow-sm overflow-hidden">
                <div class="card-header bg-transparent border-primary border-opacity-10 py-3 d-flex justify-content-between align-items-center">
                    <span class="text-white fw-bold"><i class="fas fa-history me-2 text-primary"></i>Aktivitas Terbaru</span>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-outline-primary border-0">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle mb-0">
                        <thead class="bg-primary bg-opacity-10 text-uppercase small text-secondary">
                            <tr>
                                <th class="ps-3 py-3">Tanggal</th>
                                <th>Kategori</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-end pe-3">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksiTerbaru as $t)
                            <tr class="border-bottom border-primary border-opacity-5">
                                <td class="ps-3 text-white-50 small">{{ $t->tanggal }}</td>
                                <td class="text-white">{{ $t->kategori }}</td>
                                <td class="text-center">
                                    <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3">
                                        {{ ucfirst($t->jenis) }}
                                    </span>
                                </td>
                                <td class="text-end pe-3 fw-bold">Rp {{ number_format($t->jumlah, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-secondary small">Belum ada transaksi tercatat.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- CSS KHUSUS TEMA GELAP PREISI --}}
<style>
    body { background-color: #0d1117; } /* Warna GitHub Dark sesuai template sebelumnya */
    .card { border: 1px solid rgba(13, 110, 253, 0.1) !important; transition: 0.3s ease; }
    .card:hover { border-color: rgba(13, 110, 253, 0.3) !important; transform: translateY(-3px); }
    .progress-bar { background-color: #0d6efd !important; }
</style>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Penyesuaian agar tidak error jika data kosong
const dataGrafik = {!! json_encode($grafikBulanan) !!};

const bulanNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
const labels = dataGrafik.map(item => bulanNames[item.bulan - 1] || 'Unknown');
const pemasukan = dataGrafik.map(item => item.masuk);
const pengeluaran = dataGrafik.map(item => item.keluar);

new Chart(document.getElementById('monthlyChart'), {
    type: 'line',
    data: {
        labels: labels,
        datasets: [
            { 
                label:'Pemasukan', 
                data:pemasukan, 
                borderColor:'#0d6efd', 
                backgroundColor: 'rgba(13, 110, 253, 0.1)',
                fill: true,
                tension:.4
            },
            { 
                label:'Pengeluaran', 
                data:pengeluaran, 
                borderColor:'#0dcaf0', 
                backgroundColor: 'rgba(13, 202, 240, 0.05)',
                fill: true,
                tension:.4
            }
        ]
    },
    options: {
        responsive:true,
        plugins: {
            legend: { labels: { color: '#adb5bd' } }
        },
        scales:{ 
            y:{ 
                grid: { color: 'rgba(255,255,255,0.05)' },
                ticks: { color: '#6c757d' }
            },
            x:{
                ticks: { color: '#6c757d' }
            }
        }
    }
});
</script>
@endpush