@extends('layouts.app')

@section('title', 'Tambah Transaksi')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="mb-4 text-center text-md-start">
                <h2 class="text-white fw-bold mb-1">Tambah Transaksi</h2>
                <p class="text-secondary">Catat arus kas masuk atau keluar organisasi secara akurat.</p>
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

                    <form action="{{ route('transaksi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label text-secondary small fw-bold text-uppercase">Tanggal</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark border-0 text-primary" style="border-radius: 12px 0 0 12px;"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="date" name="tanggal" class="form-control bg-dark text-white border-0 py-2" 
                                           style="border-radius: 0 12px 12px 0;" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label text-secondary small fw-bold text-uppercase">Jenis Transaksi</label>
                                <select name="jenis" class="form-select bg-dark text-white border-0 py-2 shadow-none" style="border-radius: 12px;" required>
                                    <option value="" disabled selected>-- Pilih Jenis --</option>
                                    <option value="masuk" {{ old('jenis') == 'masuk' ? 'selected' : '' }}>🟢 Pemasukan (Kredit)</option>
                                    <option value="keluar" {{ old('jenis') == 'keluar' ? 'selected' : '' }}>🔴 Pengeluaran (Debit)</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label text-secondary small fw-bold text-uppercase">Kategori</label>
                                <input type="text" name="kategori" class="form-control bg-dark text-white border-0 py-2 shadow-none" 
                                       style="border-radius: 12px;" placeholder="Contoh: Iuran Kas" value="{{ old('kategori') }}" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label text-secondary small fw-bold text-uppercase">Nominal (Rp)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark border-0 text-white fw-bold" style="border-radius: 12px 0 0 12px;">Rp</span>
                                    <input type="number" name="jumlah" class="form-control bg-dark text-white border-0 py-2 shadow-none" 
                                           style="border-radius: 0 12px 12px 0;" placeholder="0" value="{{ old('jumlah') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-secondary small fw-bold text-uppercase">Keterangan Tambahan</label>
                            <textarea name="keterangan" rows="3" class="form-control bg-dark text-white border-0 py-2 shadow-none" 
                                      style="border-radius: 12px;" placeholder="Tulis catatan singkat mengenai transaksi ini...">{{ old('keterangan') }}</textarea>
                        </div>

                        <div class="mb-5">
                            <label class="form-label text-secondary small fw-bold text-uppercase">Bukti Transaksi (File)</label>
                            <div class="p-3 bg-dark border-dashed rounded-4 text-center position-relative">
                                <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" 
                                       class="form-control opacity-0 position-absolute w-100 h-100 start-0 top-0 cursor-pointer shadow-none">
                                <div id="preview-text">
                                    <i class="fas fa-cloud-upload-alt fs-3 text-primary mb-2"></i>
                                    <p class="mb-0 small text-secondary">Klik atau tarik file ke sini untuk upload</p>
                                    <span class="text-white-50 x-small">(JPG, PNG, PDF - Maks 2MB)</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-3">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold shadow-blue py-3" style="border-radius: 15px; background: linear-gradient(45deg, #0d6efd, #00d4ff); border: none;">
                                <i class="fas fa-check-circle me-2"></i>Simpan Transaksi
                            </button>
                            <a href="{{ route('transaksi.index') }}" class="btn btn-link text-secondary text-decoration-none fw-bold small">
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
    .shadow-blue { box-shadow: 0 8px 25px rgba(13, 110, 253, 0.4); }
    .border-dashed { border: 2px dashed #30363d; }
    .cursor-pointer { cursor: pointer; }
    .x-small { font-size: 0.75rem; }
    
    input:focus, select:focus, textarea:focus {
        box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.25) !important;
        background-color: #0d1117 !important;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
    }
</style>

<script>
    // Preview nama file setelah di-upload
    document.getElementById('bukti_pembayaran').onchange = function () {
        document.getElementById('preview-text').innerHTML = '<i class="fas fa-file-alt fs-3 text-success mb-2"></i><p class="text-white mb-0">' + this.files[0].name + '</p>';
    };
</script>
@endsection