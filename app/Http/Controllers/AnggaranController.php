<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;

class AnggaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Anggaran::query();

        // Fitur Pencarian (Berdasarkan Nama Anggaran)
        if ($request->has('search')) {
            $query->where('nama_anggaran', 'like', '%' . $request->search . '%');
        }

        // Fitur Filter Periode
        if ($request->filled('periode')) {
            $query->where('periode', $request->periode);
        }

        // Ambil data dengan Pagination (10 data per halaman)
        // withQueryString memastikan filter tidak hilang saat pindah halaman pagination
        $anggaran = $query->latest()->paginate(10)->withQueryString();

        return view('admin.anggaran.index', compact('anggaran'));
    }

    public function create()
    {
        return view('admin.anggaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_anggaran' => 'required',
            'kategori' => 'required',
            'jumlah_anggaran' => 'required|numeric|min:0',
            'periode' => 'required',
        ]);

        Anggaran::create($request->all());

        return redirect()->route('anggaran.index')
            ->with('success', 'Anggaran berhasil ditambahkan');
    }

    public function edit(Anggaran $anggaran)
    {
        return view('admin.anggaran.edit', compact('anggaran'));
    }

    public function update(Request $request, Anggaran $anggaran)
    {
        $request->validate([
            'nama_anggaran' => 'required',
            'kategori' => 'required',
            'jumlah_anggaran' => 'required|numeric|min:0',
            'periode' => 'required',
        ]);

        $anggaran->update($request->all());

        return redirect()->route('anggaran.index')
            ->with('success', 'Anggaran berhasil diperbarui');
    }

    public function destroy(Anggaran $anggaran)
    {
        $anggaran->delete();

        return redirect()->route('anggaran.index')
            ->with('success', 'Anggaran berhasil dihapus');
    }
}
