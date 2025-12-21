@extends('layouts.app')

@section('title', 'Tambah Transaksi')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 bg-dark text-white">
                <div class="card-header border-secondary bg-transparent">
                    <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Transaksi Baru</h4>
                </div>
                
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('transaksi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control bg-secondary text-white border-0"
                                       value="{{ old('tanggal', date('Y-m-d')) }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Transaksi</label>
                                <select name="jenis" class="form-select bg-secondary text-white border-0" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="masuk" {{ old('jenis') == 'masuk' ? 'selected' : '' }}>Pemasukan</option>
                                    <option value="keluar" {{ old('jenis') == 'keluar' ? 'selected' : '' }}>Pengeluaran</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kategori</label>
                                <input type="text" name="kategori" class="form-control bg-secondary text-white border-0"
                                       placeholder="Contoh: Iuran Kas, Alat Tulis" value="{{ old('kategori') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nominal (Rp)</label>
                                <input type="number" name="jumlah" class="form-control bg-secondary text-white border-0"
                                       placeholder="0" value="{{ old('jumlah') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" rows="3" class="form-control bg-secondary text-white border-0" 
                                      placeholder="Tambahkan catatan singkat...">{{ old('keterangan') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran</label>
                            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" 
                                   class="form-control bg-secondary text-white border-0 @error('bukti_pembayaran') is-invalid @enderror">
                            <div class="form-text text-light-50">Format: JPG, PNG, JPEG (Maks. 2MB)</div>
                            @error('bukti_pembayaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="border-secondary">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('transaksi.index') }}" class="btn btn-outline-light">Batal</a>
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fas fa-save me-2"></i>Simpan Transaksi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection