@extends('layouts.app')

@section('title', 'Tambah Anggaran')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="mb-4 text-center text-md-start">
                <h2 class="text-white fw-bold mb-1">Tambah Anggaran</h2>
                <p class="text-secondary">Atur perencanaan dana sesuai kategori dan periode untuk kendali keuangan yang lebih baik.</p>
            </div>

            <div class="card border-0 shadow-lg" style="background-color: #161b22; border-radius: 20px;">
                <div class="card-body p-4 p-md-5">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 rounded-4 shadow-sm mb-4">
                            <ul class="mb-0 small fw-bold">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('anggaran.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label text-secondary small fw-bold text-uppercase">Nama Anggaran</label>
                                <input type="text" name="nama_anggaran" class="form-control bg-dark text-white border-0 py-2 shadow-none" 
                                       style="border-radius: 12px;" placeholder="Contoh: Anggaran Kegiatan" value="{{ old('nama_anggaran') }}" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label text-secondary small fw-bold text-uppercase">Kategori</label>
                                <input type="text" name="kategori" class="form-control bg-dark text-white border-0 py-2 shadow-none" 
                                       style="border-radius: 12px;" placeholder="Operasional / Acara" value="{{ old('kategori') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label text-secondary small fw-bold text-uppercase">Jumlah Anggaran (Rp)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark border-0 text-white fw-bold" style="border-radius: 12px 0 0 12px;">Rp</span>
                                    <input type="number" name="jumlah_anggaran" class="form-control bg-dark text-white border-0 py-2 shadow-none" 
                                           style="border-radius: 0 12px 12px 0;" placeholder="500000" value="{{ old('jumlah_anggaran') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label text-secondary small fw-bold text-uppercase">Periode</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark border-0 text-info" style="border-radius: 12px 0 0 12px;"><i class="fas fa-clock"></i></span>
                                    <input type="date" name="periode" class="form-control bg-dark text-white border-0 py-2" 
                                           style="border-radius: 0 12px 12px 0;" value="{{ old('periode') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label text-secondary small fw-bold text-uppercase">Keterangan</label>
                            <textarea name="keterangan" rows="4" class="form-control bg-dark text-white border-0 py-2 shadow-none" 
                                      style="border-radius: 12px;" placeholder="Tulis rincian atau catatan opsional mengenai anggaran ini...">{{ old('keterangan') }}</textarea>
                        </div>

                        <div class="d-grid gap-3">
                            <button type="submit" class="btn btn-info btn-lg fw-bold shadow-info py-3 text-white" style="border-radius: 15px; background: linear-gradient(45deg, #0dcaf0, #00d4ff); border: none;">
                                <i class="fas fa-save me-2"></i>Simpan Perencanaan Anggaran
                            </button>
                            <a href="{{ route('anggaran.index') }}" class="btn btn-link text-secondary text-decoration-none fw-bold small">
                                Batal & Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body { background-color: #0d1117; }
    .bg-dark { background-color: #0d1117 !important; }
    .text-uppercase { letter-spacing: 1px; }
    .shadow-info { box-shadow: 0 8px 25px rgba(13, 202, 240, 0.3); }
    
    input:focus, select:focus, textarea:focus {
        box-shadow: 0 0 0 2px rgba(13, 202, 240, 0.25) !important;
        background-color: #0d1117 !important;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
    }
</style>
@endsection