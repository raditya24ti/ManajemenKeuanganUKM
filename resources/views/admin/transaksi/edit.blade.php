@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')
<div class="container">
    <h4 class="mb-3">Edit Transaksi</h4>

    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control"
                   value="{{ old('tanggal', $transaksi->tanggal) }}" required>
        </div>

        <div class="mb-3">
            <label>Jenis Transaksi</label>
            <select name="jenis" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="masuk" {{ $transaksi->jenis == 'masuk' ? 'selected' : '' }}>
                    Pemasukan
                </option>
                <option value="keluar" {{ $transaksi->jenis == 'keluar' ? 'selected' : '' }}>
                    Pengeluaran
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control"
                   value="{{ old('kategori', $transaksi->kategori) }}" required>
        </div>

        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control"
                   value="{{ old('jumlah', $transaksi->jumlah) }}" required>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ old('keterangan', $transaksi->keterangan) }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
