@extends('layouts.app')

@section('title','Edit Anggaran')

@section('content')
<div class="container">
    <h4 class="mb-3">Edit Anggaran</h4>

    <form action="{{ route('anggaran.update', $anggaran->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Anggaran</label>
            <input type="text" name="nama_anggaran" class="form-control"
                   value="{{ old('nama_anggaran', $anggaran->nama_anggaran) }}" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control"
                   value="{{ old('kategori', $anggaran->kategori) }}" required>
        </div>

        <div class="mb-3">
            <label>Jumlah Anggaran</label>
            <input type="number" name="jumlah_anggaran" class="form-control"
                   value="{{ old('jumlah_anggaran', $anggaran->jumlah_anggaran) }}" required>
        </div>

        <div class="mb-3">
            <label>Periode</label>
            <input type="month" name="periode" class="form-control"
                   value="{{ old('periode', $anggaran->periode) }}" required>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ old('keterangan', $anggaran->keterangan) }}</textarea>
        </div>

        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('anggaran.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
