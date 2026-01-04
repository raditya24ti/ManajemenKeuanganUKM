@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <h2 class="text-white font-weight-bold">Edit Transaksi</h2>
        <p class="text-secondary" style="color: #8b949e !important;">Perbarui rincian arus kas masuk atau keluar organisasi Anda.</p>
    </div>

    <div class="card shadow-lg border-0" style="background-color: #1a1e26; border-radius: 15px;">
        <div class="card-body p-4 p-md-5">
            
            <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="text-uppercase small font-weight-bold mb-2" style="color: #8b949e !important;">TANGGAL</label>
                        <input type="date" name="tanggal" class="form-control custom-input" 
                               value="{{ old('tanggal', $transaksi->tanggal) }}" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="text-uppercase small font-weight-bold mb-2" style="color: #8b949e !important;">JENIS TRANSAKSI</label>
                        <select name="jenis" class="form-select custom-input" required>
                            <option value="" disabled>-- Pilih Jenis --</option>
                            <option value="masuk" {{ $transaksi->jenis == 'masuk' ? 'selected' : '' }}>🟢 Pemasukan</option>
                            <option value="keluar" {{ $transaksi->jenis == 'keluar' ? 'selected' : '' }}>🔴 Pengeluaran</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="text-uppercase small font-weight-bold mb-2" style="color: #8b949e !important;">KATEGORI</label>
                        <input type="text" name="kategori" class="form-control custom-input"
                               value="{{ old('kategori', $transaksi->kategori) }}" placeholder="Contoh: Iuran Kas" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="text-uppercase small font-weight-bold mb-2" style="color: #8b949e !important;">NOMINAL (RP)</label>
                        <input type="number" name="jumlah" class="form-control custom-input"
                               value="{{ old('jumlah', $transaksi->jumlah) }}" placeholder="0" required>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="text-uppercase small font-weight-bold mb-2" style="color: #8b949e !important;">KETERANGAN TAMBAHAN</label>
                    <textarea name="keterangan" rows="3" class="form-control custom-input" 
                              placeholder="Tulis rincian catatan transaksi ini...">{{ old('keterangan', $transaksi->keterangan) }}</textarea>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-cyan btn-block font-weight-bold py-3">
                        <i class="fas fa-check-circle mr-2"></i> Simpan Perubahan Transaksi
                    </button>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('transaksi.index') }}" class="text-secondary small font-weight-bold" style="text-decoration: none;">Batal & Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    body { background-color: #0d1117; }

    /* Custom Input Style agar Identik dengan Tambah Anggaran */
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
        background-color: #12151c !important;
    }

    /* Select Option Styling */
    select.custom-input option {
        background-color: #1a1e26;
        color: white;
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

    /* Date Picker Icon Color */
    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
        cursor: pointer;
    }
</style>
@endsection