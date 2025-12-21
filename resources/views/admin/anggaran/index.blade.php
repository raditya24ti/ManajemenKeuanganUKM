@extends('layouts.app')

@section('title', 'Manajemen Anggaran')

@section('content')
<div class="container py-4">
    {{-- HEADER (Tombol dihapus agar presisi, pindahkan ke sidebar atau biarkan jika hanya ingin satu di Index) --}}
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h2 class="text-white fw-bold mb-0">Manajemen Anggaran</h2>
            <p class="text-secondary mb-0">Rencanakan dan pantau alokasi dana UKM Anda.</p>
        </div>
        {{-- Jika ingin menghapus tombol ini, hapus baris di bawah ini --}}
        <a href="{{ route('anggaran.create') }}" class="btn btn-primary px-4 shadow-sm">
            <i class="fas fa-plus-circle me-2"></i>Tambah Anggaran
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-primary bg-primary bg-opacity-10 text-primary border-primary border-opacity-25 mb-4">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    </div>
    @endif

    {{-- Tabel dengan Styling Biru Presisi --}}
    <div class="card bg-dark border-primary border-opacity-10 shadow-lg overflow-hidden">
        <div class="table-responsive">
            <table class="table table-dark table-hover mb-0" style="background-color: #1a1a1a;">
                <thead style="background-color: #1c2128;">
                    <tr class="text-secondary border-bottom border-primary border-opacity-10">
                        <th class="ps-4 py-3 fw-semibold small text-uppercase">Nama Anggaran</th>
                        <th class="py-3 fw-semibold small text-uppercase">Kategori</th>
                        <th class="py-3 fw-semibold small text-uppercase">Periode</th>
                        <th class="py-3 fw-semibold small text-uppercase">Alokasi Dana</th>
                        <th class="pe-4 py-3 fw-semibold small text-uppercase text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @forelse($anggaran as $a)
                    <tr class="border-bottom border-primary border-opacity-10">
                        <td class="ps-4 text-white fw-medium">
                            {{ $a->nama_anggaran }}
                        </td>
                        <td>
                            <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3">
                                {{ $a->kategori }}
                            </span>
                        </td>
                        <td class="text-white-50">
                            {{ $a->periode }}
                        </td>
                        <td class="fw-bold text-info">
                            Rp {{ number_format($a->jumlah_anggaran, 0, ',', '.') }}
                        </td>
                        <td class="pe-4 text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('anggaran.edit', $a->id) }}" class="btn btn-sm btn-outline-info border-0 p-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('anggaran.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Hapus anggaran ini?')">
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
                        <td colspan="5" class="text-center py-5">
                            <i class="fas fa-wallet fa-3x text-primary opacity-25 mb-3"></i>
                            <p class="text-secondary small">Belum ada data anggaran yang dibuat.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    body { background-color: #0d1117; } /* Warna Gelap Identik dengan Gambar Sebelumnya */
    .card { border: 1px solid rgba(13, 110, 253, 0.1) !important; }
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05) !important;
    }
    .btn-outline-info:hover { color: #fff; background-color: #0dcaf0; }
</style>
@endsection