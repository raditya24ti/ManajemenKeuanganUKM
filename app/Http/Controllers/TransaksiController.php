<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;


class TransaksiController extends Controller
{
    public function index()
{
    $transaksi = Transaksi::latest()->get();

    // SESUAIKAN DENGAN FOLDER VIEW
    return view('admin.transaksi.index', compact('transaksi'));
}


    public function create()
    {
        return view('admin.transaksi.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'tanggal' => 'required|date',
        'jenis'   => 'required|in:masuk,keluar',
        'kategori'=> 'required|string|max:100',
        'jumlah'  => 'required|numeric|min:0',
        'keterangan' => 'nullable|string'
    ]);

    Transaksi::create([
        'tanggal'    => $request->tanggal,
        'jenis'      => $request->jenis,
        'kategori'   => $request->kategori,
        'jumlah'     => $request->jumlah,
        'keterangan' => $request->keterangan,
    ]);

    return redirect()
        ->route('transaksi.index')
        ->with('success', 'Transaksi berhasil ditambahkan');
}

    public function edit(Transaksi $transaksi)
    {
        return view('admin.transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis'   => 'required|in:masuk,keluar',
            'kategori'=> 'required|string|max:100',
            'jumlah'  => 'required|numeric|min:0',
        ]);

        $transaksi->update([
            'tanggal'    => $request->tanggal,
            'jenis'      => $request->jenis,
            'kategori'   => $request->kategori,
            'jumlah'     => $request->jumlah,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus');
    }
}

