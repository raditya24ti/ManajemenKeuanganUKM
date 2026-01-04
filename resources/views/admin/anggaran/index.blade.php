@extends('layouts.app')

@section('title', 'Manajemen Anggaran')

@section('content')
<div class="container py-4">
    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h2 class="text-white fw-bold mb-0">Manajemen Anggaran</h2>
            <p class="text-secondary mb-0">Rencanakan dan pantau alokasi dana UKM Anda.</p>
        </div>
        <a href="{{ route('anggaran.create') }}" class="btn btn-primary px-4 py-2 shadow-blue fw-bold" style="border-radius: 12px; background: linear-gradient(45deg, #0d6efd, #00d4ff); border: none;">
            <i class="fas fa-plus-circle me-2"></i>Tambah Anggaran
        </a>
    </div>

    {{-- KOTAK FILTER & SEARCH --}}
    <div class="card border-0 mb-4 shadow-lg" style="background-color: #161b22; border-radius: 20px;">
        <div class="card-body p-4">
            <form action="{{ route('anggaran.index') }}" method="GET" class="row g-3 align-items-end">
                {{-- FILTER PERIODE --}}
                <div class="col-md-3">
                    <label class="small text-secondary fw-bold text-uppercase mb-2 d-block">Filter Periode</label>
                    <input type="month" name="periode" class="form-control bg-dark text-white border-0 py-2 shadow-none" 
                           style="border-radius: 10px;" value="{{ request('periode') }}" onchange="this.form.submit()">
                </div>

                {{-- PENCARIAN --}}
                <div class="col-md-5">
                    <label class="small text-secondary fw-bold text-uppercase mb-2 d-block">Pencarian</label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark border-0 text-secondary" style="border-radius: 10px 0 0 10px;">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control bg-dark text-white border-0 py-2 shadow-none" 
                               style="border-radius: 0 10px 10px 0;" placeholder="Cari nama anggaran..." value="{{ request('search') }}">
                    </div>
                </div>

                {{-- TOMBOL AKSI --}}
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1 py-2 fw-bold" style="border-radius: 10px;">
                        Cari
                    </button>
                    <a href="{{ route('anggaran.index') }}" class="btn btn-outline-secondary py-2 px-3" style="border-radius: 10px; border-color: #30363d;">
                        <i class="fas fa-undo"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-primary bg-primary bg-opacity-10 text-primary border-primary border-opacity-25 mb-4">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    </div>
    @endif

    {{-- TABEL --}}
    <div class="card border-0 shadow-lg overflow-hidden" style="background-color: #161b22; border-radius: 20px;">
        <div class="table-responsive">
            <table class="table table-dark table-hover mb-0 align-middle">
                <thead>
                    <tr class="text-secondary" style="background-color: #1c2128;">
                        <th class="ps-4 py-3 small text-uppercase fw-bold">Nama Anggaran</th>
                        <th class="py-3 small text-uppercase fw-bold">Kategori</th>
                        <th class="py-3 small text-uppercase fw-bold text-center">Periode</th>
                        <th class="py-3 small text-uppercase fw-bold text-end">Alokasi Dana</th>
                        <th class="pe-4 py-3 small text-uppercase fw-bold text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($anggaran as $a)
                    <tr class="border-bottom border-secondary border-opacity-10">
                        <td class="ps-4 text-white fw-bold">
                            {{ $a->nama_anggaran }}
                        </td>
                        <td>
                            <span class="badge rounded-pill" style="background: rgba(13, 110, 253, 0.1); color: #3498db; border: 1px solid rgba(52, 152, 219, 0.2);">
                                {{ $a->kategori }}
                            </span>
                        </td>
                        <td class="text-center text-white-50 small">
                            {{ $a->periode }}
                        </td>
                        <td class="text-end fw-bold text-info">
                            Rp {{ number_format($a->jumlah_anggaran, 0, ',', '.') }}
                        </td>
                        <td class="pe-4">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('anggaran.edit', $a->id) }}" class="btn btn-sm btn-icon-hover text-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('anggaran.destroy', $a->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-icon-hover text-danger" onclick="return confirm('Hapus anggaran ini?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="opacity-25 mb-3">
                                <i class="fas fa-wallet fa-4x text-primary"></i>
                            </div>
                            <h5 class="text-secondary">Tidak ada data anggaran ditemukan</h5>
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
            Menampilkan <b>{{ $anggaran->firstItem() ?? 0 }}</b> - <b>{{ $anggaran->lastItem() ?? 0 }}</b> dari <b>{{ $anggaran->total() }}</b> anggaran
        </div>
        <div class="modern-pagination">
            {{ $anggaran->links() }}
        </div>
    </div>
</div>

<style>
    body { background-color: #0d1117; }
    .bg-dark { background-color: #0d1117 !important; }
    .shadow-blue { box-shadow: 0 8px 20px rgba(13, 110, 253, 0.2); }
    
    .table-hover tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.03) !important;
    }

    .btn-icon-hover {
        width: 35px; height: 35px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 10px; transition: 0.2s; border: none; background: transparent;
    }

    .btn-icon-hover:hover { background-color: rgba(255, 255, 255, 0.08); }

    input[type="month"]::-webkit-calendar-picker-indicator { filter: invert(1); }

    /* Pagination Styling */
    .pagination .page-link {
        background-color: #161b22; border: 1px solid #30363d;
        color: #c9d1d9; border-radius: 8px; margin: 0 2px;
    }
    .pagination .page-item.active .page-link {
        background-color: #0d6efd; border-color: #0d6efd;
    }
</style>
@endsection