@extends('layouts.app')
@section('title','Dashboard')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-semibold mb-1">Dashboard Keuangan</h3>
            <small class="text-muted">Ringkasan data keuangan UKM</small>
        </div>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Tambah Transaksi
        </a>
    </div>

    {{-- SUMMARY --}}
    <div class="row g-3 mb-4">
        @foreach([
            ['Total Pemasukan','success',$totalMasuk,'fa-arrow-down'],
            ['Total Pengeluaran','danger',$totalKeluar,'fa-arrow-up'],
            ['Saldo','primary',$saldo,'fa-wallet'],
            ['Total Anggaran','info',$totalAnggaran,'fa-chart-pie']
        ] as [$label,$color,$value,$icon])
        <div class="col-md-3">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">{{ $label }}</small>
                        <h5 class="fw-semibold text-{{ $color }} mb-0">
                            Rp {{ number_format($value) }}
                        </h5>
                    </div>
                    <i class="fas {{ $icon }} fa-lg text-{{ $color }} opacity-75"></i>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- GRAFIK & ANGGARAN --}}
    <div class="row g-3 mb-4">
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-header">
                    Grafik Pemasukan & Pengeluaran Bulanan
                </div>
                <div class="card-body">
                    <canvas id="monthlyChart" height="120"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    Penggunaan Anggaran
                </div>
                <div class="card-body">
                    <div class="progress mb-3" style="height:18px">
                        <div class="progress-bar
                            {{ $persenAnggaran >= 100 ? 'bg-danger' : 'bg-success' }}"
                            style="width: {{ min($persenAnggaran,100) }}%">
                            {{ round($persenAnggaran) }}%
                        </div>
                    </div>
                    <small class="text-muted">
                        Rp {{ number_format($anggaranTerpakai) }}
                        dari Rp {{ number_format($totalAnggaran) }}
                    </small>
                </div>
            </div>
        </div>
    </div>

    {{-- PENGELUARAN PER KATEGORI --}}
    <div class="card mb-4">
        <div class="card-header">
            Pengeluaran per Kategori
        </div>
        <ul class="list-group list-group-flush">
            @forelse($kategori as $k)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $k->kategori }}
                <span class="fw-semibold">
                    Rp {{ number_format($k->total) }}
                </span>
            </li>
            @empty
            <li class="list-group-item text-center text-muted">
                Belum ada data kategori
            </li>
            @endforelse
        </ul>
    </div>

    {{-- TRANSAKSI TERBARU --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Transaksi Terbaru</span>
            <a href="{{ route('transaksi.index') }}"
               class="btn btn-sm btn-outline-primary">
                Lihat Semua
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksiTerbaru as $t)
                    <tr>
                        <td>{{ $t->tanggal }}</td>
                        <td>{{ $t->kategori }}</td>
                        <td>
                            <span class="badge {{ $t->jenis=='masuk'?'bg-success':'bg-danger' }}">
                                {{ ucfirst($t->jenis) }}
                            </span>
                        </td>
                        <td>Rp {{ number_format($t->jumlah) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            Belum ada transaksi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const bulan = {!! json_encode(
    $grafikBulanan->pluck('bulan')->map(fn($b)=>date('M',mktime(0,0,0,$b,1)))
) !!};
const pemasukan = {!! json_encode($grafikBulanan->pluck('masuk')) !!};
const pengeluaran = {!! json_encode($grafikBulanan->pluck('keluar')) !!};

new Chart(document.getElementById('monthlyChart'), {
    type: 'line',
    data: {
        labels: bulan,
        datasets: [
            { label:'Pemasukan', data:pemasukan, borderColor:'green', tension:.4 },
            { label:'Pengeluaran', data:pengeluaran, borderColor:'red', tension:.4 }
        ]
    },
    options: {
        responsive:true,
        scales:{ y:{ beginAtZero:true } }
    }
});
</script>
@endpush
