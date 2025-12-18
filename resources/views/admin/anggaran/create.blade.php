@extends('layouts.app')
@section('title','Tambah Anggaran')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Tambah Anggaran</h4>
        <small class="text-muted">
            Atur perencanaan dana sesuai kategori dan periode
        </small>
    </div>
</div>

{{-- CARD FORM --}}
<div class="card">
    <div class="card-body p-4">

        <form action="{{ route('anggaran.store') }}" method="POST">
            @csrf

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Nama Anggaran</label>
                    <input type="text"
                           name="nama_anggaran"
                           class="form-control"
                           placeholder="Contoh: Anggaran Kegiatan"
                           value="{{ old('nama_anggaran') }}"
                           required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Kategori</label>
                    <input type="text"
                           name="kategori"
                           class="form-control"
                           placeholder="Operasional / Acara"
                           value="{{ old('kategori') }}"
                           required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Jumlah Anggaran</label>
                    <input type="number"
                           name="jumlah_anggaran"
                           class="form-control"
                           placeholder="500000"
                           value="{{ old('jumlah_anggaran') }}"
                           required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Periode</label>
                    <input type="month"
                           name="periode"
                           class="form-control"
                           value="{{ old('periode') }}"
                           required>
                </div>

                <div class="col-12">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan"
                              class="form-control"
                              rows="3"
                              placeholder="Opsional">{{ old('keterangan') }}</textarea>
                </div>

            </div>

            {{-- BUTTON --}}
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('anggaran.index') }}"
                   class="btn btn-outline-secondary px-4">
                    Batal
                </a>
                <button type="submit"
                        class="btn btn-primary px-4">
                    Simpan Anggaran
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
