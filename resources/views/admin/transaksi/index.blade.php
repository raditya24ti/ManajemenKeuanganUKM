@extends('layouts.app')

@section('title', 'Manajemen Transaksi')

@section('content')
<div class="container py-5">
    {{-- HEADER --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5 gap-3">
        <div>
            <h2 class="text-white fw-bold mb-1">Manajemen Transaksi</h2>
            <p class="text-secondary mb-0">Pantau dan kelola seluruh arus kas UKM secara real-time.</p>
        </div>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary px-4 py-2 shadow-blue fw-bold" style="border-radius: 12px; background: linear-gradient(45deg, #0d6efd, #00d4ff); border: none;">
            <i class="fas fa-plus-circle me-2"></i>Tambah Transaksi
        </a>
    </div>

    {{-- KOTAK FILTER & SEARCH --}}
    <div class="card border-0 mb-4 shadow-lg" style="background-color: #161b22; border-radius: 20px;">
        <div class="card-body p-4">
            <form action="{{ route('transaksi.index') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-md-3">
                    <label class="small text-secondary fw-bold text-uppercase mb-2 d-block">Filter Jenis</label>
                    <select name="jenis" class="form-select bg-dark text-white border-0 py-2 shadow-none" style="border-radius: 10px;" onchange="this.form.submit()">
                        <option value="">Semua Arus Kas</option>
                        <option value="masuk" {{ request('jenis') == 'masuk' ? 'selected' : '' }}>🟢 Pemasukan</option>
                        <option value="keluar" {{ request('jenis') == 'keluar' ? 'selected' : '' }}>🔴 Pengeluaran</option>
                    </select>
                </div>

                <div class="col-md-5">
                    <label class="small text-secondary fw-bold text-uppercase mb-2 d-block">Pencarian</label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark border-0 text-secondary" style="border-radius: 10px 0 0 10px;">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control bg-dark text-white border-0 py-2 shadow-none"
                               style="border-radius: 0 10px 10px 0;" placeholder="Cari kategori atau keterangan..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-4 d-flex align-items-end gap-2 pt-md-4">
                    <button type="submit" class="btn btn-primary flex-grow-1 py-2 fw-bold" style="border-radius: 10px;">
                        Cari
                    </button>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary py-2 px-3" style="border-radius: 10px;">
                        <i class="fas fa-undo"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- TABEL --}}
    <div class="card border-0 shadow-lg overflow-hidden" style="background-color: #161b22; border-radius: 20px;">
        <div class="table-responsive">
            <table class="table table-dark table-hover mb-0 align-middle">
                <thead>
                    <tr class="text-secondary" style="background-color: #1c2128;">
                        <th class="ps-4 py-3 small text-uppercase fw-bold">Tanggal</th>
                        <th class="py-3 small text-uppercase fw-bold text-center">Jenis</th>
                        <th class="py-3 small text-uppercase fw-bold">Kategori</th>
                        <th class="py-3 small text-uppercase fw-bold">Nominal</th>
                        <th class="py-3 small text-uppercase fw-bold text-center">Bukti</th>
                        <th class="pe-4 py-3 small text-uppercase fw-bold text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi as $item)
                    <tr class="border-bottom border-secondary border-opacity-10">
                        <td class="ps-4 text-white-50">
                            <div class="fw-bold text-white">{{ \Carbon\Carbon::parse($item->tanggal)->format('d') }}</div>
                            <div class="small">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('M Y') }}</div>
                        </td>
                        <td class="text-center">
                            @if($item->jenis == 'masuk')
                                <span class="badge rounded-pill" style="background: rgba(40, 167,  green 69, 0.1); color: #2ecc71; border: 1px solid rgba(46, 204, 113, 0.2);">
                                    <i class="fas fa-arrow-down small me-1"></i> Masuk
                                </span>
                            @else
                                <span class="badge rounded-pill" style="background: rgba(231, 76, 60, 0.1); color: #e74c3c; border: 1px solid rgba(231, 76, 60, 0.2);">
                                    <i class="fas fa-arrow-up small me-1"></i> Keluar
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="text-white fw-semibold">{{ $item->kategori }}</div>
                            <div class="text-secondary x-small text-truncate" style="max-width: 150px;" title="{{ $item->keterangan }}">
                                {{ $item->keterangan ?? '-' }}
                            </div>
                        </td>
                        <td class="fw-bold {{ $item->jenis == 'masuk' ? 'text-primary' : 'text-danger' }}">
                            {{ $item->jenis == 'masuk' ? '+' : '-' }} Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                        </td>
                        <td class="text-center">
                            @if($item->bukti_pembayaran)
                                <a href="{{ asset('storage/' . $item->bukti_pembayaran) }}" target="_blank" class="btn btn-sm btn-dark border-0 text-info" style="border-radius: 8px;">
                                    <i class="fas fa-file-invoice fs-5"></i>
                                </a>
                            @else
                                <span class="text-muted x-small">N/A</span>
                            @endif
                        </td>
                        <td class="pe-4">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('transaksi.edit', $item->id) }}" class="btn btn-sm btn-icon-hover text-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-icon-hover text-danger" onclick="return confirm('Hapus transaksi ini?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="opacity-25 mb-3">
                                <i class="fas fa-receipt fa-4x text-primary"></i>
                            </div>
                            <h5 class="text-secondary">Belum ada transaksi</h5>
                            <p class="text-muted small">Mulai catat transaksi pertama Anda hari ini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
        <div class="text-secondary small">
            Menampilkan <b>{{ $transaksi->firstItem() ?? 0 }}</b> - <b>{{ $transaksi->lastItem() ?? 0 }}</b> dari <b>{{ $transaksi->total() }}</b> transaksi
        </div>
        <div class="modern-pagination">
            {{ $transaksi->links() }}
        </div>
    </div>
</div>

<style>
    body { background-color: #0d1117; color: #c9d1d9; }
    .bg-dark { background-color: #0d1117 !important; }
    .shadow-blue { box-shadow: 0 8px 20px rgba(13, 110, 253, 0.2); }
    .x-small { font-size: 0.75rem; }

    .table-hover tbody tr { transition: 0.2s; }
    .table-hover tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.03) !important;
        transform: scale(1.002);
    }

    .btn-icon-hover {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: 0.2s;
        border: none;
        background: transparent;
    }

    .btn-icon-hover:hover {
        background-color: rgba(255, 255, 255, 0.08);
    }

    /* Custom Scrollbar for Table */
    .table-responsive::-webkit-scrollbar { height: 8px; }
    .table-responsive::-webkit-scrollbar-track { background: #161b22; }
    .table-responsive::-webkit-scrollbar-thumb { background: #30363d; border-radius: 10px; }

    /* Pagination Styling */
    .pagination .page-link {
        background-color: #161b22;
        border: 1px solid #30363d;
        color: #c9d1d9;
        margin: 0 2px;
        border-radius: 8px;
    }
    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
        font-weight: bold;
    }
    .pagination .page-link:hover {
        background-color: #30363d;
    }
</style>
@endsection
