@extends('layouts.app')

@section('title', 'Manajemen Transaksi')

@section('content')
<div class="container py-4">
    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h2 class="text-white fw-bold mb-0">Manajemen Transaksi</h2>
            <p class="text-secondary mb-0">Pantau seluruh arus kas UKM Anda di sini.</p>
        </div>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary px-4 shadow-sm">
            <i class="fas fa-plus-circle me-2"></i>Tambah Transaksi
        </a>
    </div>

    {{-- KOTAK FILTER & SEARCH (DENGAN BUTTON RESET) --}}
    <div class="card bg-dark border-primary border-opacity-10 mb-4 shadow-lg">
        <div class="card-body p-3">
            <form action="{{ route('transaksi.index') }}" method="GET" class="row g-2 align-items-center">
                {{-- Filter Jenis --}}
                <div class="col-md-2">
                    <select name="jenis" class="form-select bg-black text-white border-primary border-opacity-25" onchange="this.form.submit()">
                        <option value="">Semua Jenis</option>
                        <option value="masuk" {{ request('jenis') == 'masuk' ? 'selected' : '' }}>Pemasukan</option>
                        <option value="keluar" {{ request('jenis') == 'keluar' ? 'selected' : '' }}>Pengeluaran</option>
                    </select>
                </div>

                {{-- Input Search --}}
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-black border-primary border-opacity-25 text-secondary">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control bg-black text-white border-primary border-opacity-25" 
                               placeholder="Cari berdasarkan kategori atau keterangan..." value="{{ request('search') }}">
                    </div>
                </div>

                {{-- Button Filter --}}
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                </div>

                {{-- Button Reset --}}
                <div class="col-md-2">
                    <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary w-100 border-primary border-opacity-25 text-white">
                        <i class="fas fa-undo me-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- TABEL TEMA BIRU --}}
    <div class="card bg-dark border-primary border-opacity-10 shadow-lg overflow-hidden">
        <div class="table-responsive">
            <table class="table table-dark table-hover mb-0" style="background-color: #1a1a1a;">
                <thead style="background-color: #1c2128;">
                    <tr class="text-secondary border-bottom border-primary border-opacity-10">
                        <th class="ps-4 py-3 fw-semibold small text-uppercase">Tanggal</th>
                        <th class="py-3 fw-semibold small text-uppercase">Jenis</th>
                        <th class="py-3 fw-semibold small text-uppercase">Kategori</th>
                        <th class="py-3 fw-semibold small text-uppercase">Nominal</th>
                        <th class="py-3 fw-semibold small text-uppercase">Keterangan</th>
                        <th class="pe-4 py-3 fw-semibold small text-uppercase text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @forelse($transaksi as $item)
                    <tr class="border-bottom border-primary border-opacity-10">
                        <td class="ps-4 text-white-50 small">
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                        </td>
                        <td>
                            @if($item->jenis == 'masuk')
                                <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3">
                                    <i class="fas fa-arrow-down small me-1"></i> Masuk
                                </span>
                            @else
                                <span class="badge rounded-pill bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-3">
                                    <i class="fas fa-arrow-up small me-1"></i> Keluar
                                </span>
                            @endif
                        </td>
                        <td class="text-white">{{ $item->kategori }}</td>
                        <td class="fw-bold {{ $item->jenis == 'masuk' ? 'text-primary' : 'text-info' }}">
                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                        </td>
                        <td class="text-secondary small" title="{{ $item->keterangan }}">
                            {{ Str::limit($item->keterangan, 35) }}
                        </td>
                        <td class="pe-4 text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('transaksi.edit', $item->id) }}" class="btn btn-sm btn-outline-info border-0 p-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger border-0 p-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="fas fa-receipt fa-3x text-primary opacity-25 mb-3"></i>
                            <p class="text-secondary small">Tidak ada data transaksi yang ditemukan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-4 d-flex justify-content-between align-items-center">
        <div class="text-secondary small">
            Menampilkan {{ $transaksi->firstItem() ?? 0 }} sampai {{ $transaksi->lastItem() ?? 0 }} dari {{ $transaksi->total() }} data
        </div>
        <div>
            {{ $transaksi->links() }}
        </div>
    </div>
</div>

<style>
    body { background-color: #0d1117; }
    .card { border: 1px solid rgba(13, 110, 253, 0.1) !important; }
    .form-control:focus, .form-select:focus {
        background-color: #000;
        color: #fff;
        border-color: #0d6efd;
        box-shadow: none;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05) !important;
    }
    .pagination .page-link {
        background-color: #1a1a1a;
        border-color: #333;
        color: #ccc;
    }
    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
</style>
@endsection