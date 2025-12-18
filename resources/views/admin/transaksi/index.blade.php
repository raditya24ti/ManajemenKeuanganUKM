@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@section('content')
<div class="container">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Daftar Transaksi</h4>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary">
            + Tambah Transaksi
        </a>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Card Table -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Kategori</th>
                        <th class="text-end">Jumlah</th>
                        <th class="text-center" width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi as $t)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d M Y') }}</td>
                            <td>
                                <span class="badge {{ $t->jenis == 'masuk' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $t->jenis == 'masuk' ? 'Pemasukan' : 'Pengeluaran' }}
                                </span>
                            </td>
                            <td>{{ $t->kategori }}</td>
                            <td class="text-end">Rp {{ number_format($t->jumlah, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <a href="{{ route('transaksi.edit', $t->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('transaksi.destroy', $t->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Yakin ingin menghapus transaksi ini?')"
                                            class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Belum ada transaksi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
