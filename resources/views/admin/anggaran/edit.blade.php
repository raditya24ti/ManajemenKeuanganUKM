@extends('layouts.app')

@section('title', 'Edit Anggaran')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="mb-4 text-center text-md-start">
                <h2 class="text-white fw-bold mb-1">Edit Anggaran</h2>
                <p class="text-secondary" style="color: #8b949e !important;">Perbarui detail perencanaan dana untuk periode ini secara akurat.</p>
            </div>

            <div class="card border-0 shadow-lg" style="background-color: #1a1e26; border-radius: 15px;">
                <div class="card-body p-4 p-md-5">
                    
                    <form action="{{ route('anggaran.update', $anggaran->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="text-uppercase small font-weight-bold mb-2" style="color: #8b949e !important;">Nama Anggaran</label>
                                <input type="text" name="nama_anggaran" class="form-control custom-input"
                                       value="{{ old('nama_anggaran', $anggaran->nama_anggaran) }}" placeholder="Contoh: Operasional UKM" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="text-uppercase small font-weight-bold mb-2" style="color: #8b949e !important;">Kategori</label>
                                <input type="text" name="kategori" class="form-control custom-input"
                                       value="{{ old('kategori', $anggaran->kategori) }}" placeholder="Contoh: Kegiatan" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="text-uppercase small font-weight-bold mb-2" style="color: #8b949e !important;">Jumlah Anggaran (Rp)</label>
                                <input type="number" name="jumlah_anggaran" class="form-control custom-input"
                                       value="{{ old('jumlah_anggaran', $anggaran->jumlah_anggaran) }}" placeholder="0" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="text-uppercase small font-weight-bold mb-2" style="color: #8b949e !important;">Periode</label>
                                <input type="month" name="periode" class="form-control custom-input"
                                       value="{{ old('periode', $anggaran->periode) }}" required>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="text-uppercase small font-weight-bold mb-2" style="color: #8b949e !important;">Keterangan</label>
                            <textarea name="keterangan" rows="3" class="form-control custom-input" 
                                      placeholder="Tulis rincian atau catatan opsional mengenai anggaran ini...">{{ old('keterangan', $anggaran->keterangan) }}</textarea>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-cyan btn-block font-weight-bold py-3">
                                <i class="fas fa-sync-alt mr-2"></i> Update Perencanaan Anggaran
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('anggaran.index') }}" class="text-secondary small font-weight-bold" style="text-decoration: none;">
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
    
    /* Input Styling: Identik dengan Tambah Anggaran */
    .custom-input {
        background-color: #12151c !important;
        border: 1px solid #2d333b !important;
        color: #ffffff !important;
        border-radius: 8px;
        padding: 12px 15px;
    }

    .custom-input::placeholder {
        color: #4b5563 !important;
    }

    .custom-input:focus {
        border-color: #00e5ff !important;
        box-shadow: 0 0 8px rgba(0, 229, 255, 0.2);
        outline: none;
    }

    /* Tombol Cyan Neon */
    .btn-cyan {
        background-color: #00e5ff;
        color: #000;
        border: none;
        border-radius: 10px;
        width: 100%;
        box-shadow: 0 4px 15px rgba(0, 229, 255, 0.3);
        transition: all 0.3s;
    }

    .btn-cyan:hover {
        background-color: #00d4ec;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 229, 255, 0.5);
    }

    /* Fix Icon Date/Month Picker */
    input[type="month"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
        cursor: pointer;
    }
</style>
@endsection