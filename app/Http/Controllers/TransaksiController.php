<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;


class TransaksiController extends Controller
{
   public function index(Request $request)
{
    // Menggunakan query builder agar bisa ditambah filter secara dinamis
    $query = Transaksi::query();

    // 1. Fitur Search (berdasarkan keterangan atau kategori)
    if ($request->has('search') && $request->search != '') {
        $query->where(function($q) use ($request) {
            $q->where('keterangan', 'like', '%' . $request->search . '%')
              ->orWhere('kategori', 'like', '%' . $request->search . '%');
        });
    }

    // 2. Fitur Filter (berdasarkan jenis: masuk/keluar)
    if ($request->has('jenis') && $request->jenis != '') {
        $query->where('jenis', $request->jenis);
    }

    // 3. Fitur Pagination (menampilkan 10 data per halaman)
    // withQueryString() penting agar saat pindah halaman, filter search tidak hilang
    $transaksi = $query->latest()->paginate(10)->withQueryString();

    return view('admin.transaksi.index', compact('transaksi'));
}

    public function create()
    {
        return view('admin.transaksi.create');
    }

public function edit(Transaksi $transaksi)
{
    return view('admin.transaksi.edit', compact('transaksi'));
}

 public function store(Request $request)
{
    $validated = $request->validate([
        'tanggal' => 'required',
        'jenis' => 'required',
        'kategori' => 'required',
        'jumlah' => 'required|numeric',
        'keterangan' => 'required',
        'bukti_pembayaran' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('bukti_pembayaran')) {
        $file = $request->file('bukti_pembayaran');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('uploads/bukti'), $nama_file);
        $validated['bukti_pembayaran'] = $nama_file; // Masukkan nama file ke data validasi
    }

    // Gunakan $validated untuk keamanan
    Transaksi::create($validated);

    return redirect()->route('transaksi.index')
        ->with('success', 'Transaksi berhasil disimpan!');
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

