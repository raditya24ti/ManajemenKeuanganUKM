@extends('layouts.app')

@section('title','Anggaran')

@section('content')
<a href="{{ route('anggaran.create') }}" class="btn btn-primary mb-3">
    + Tambah Anggaran
</a>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Periode</th>
        <th>Jumlah</th>
        <th>Aksi</th>
    </tr>
    @foreach($anggaran as $a)
    <tr>
        <td>{{ $a->nama_anggaran }}</td>
        <td>{{ $a->kategori }}</td>
        <td>{{ $a->periode }}</td>
        <td>Rp {{ number_format($a->jumlah_anggaran) }}</td>
        <td>
            <a href="{{ route('anggaran.edit',$a->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('anggaran.destroy',$a->id) }}" method="POST" style="display:inline">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm"
                    onclick="return confirm('Hapus anggaran?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
