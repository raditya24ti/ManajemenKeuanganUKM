<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Anggaran;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // TOTAL - Menghitung berdasarkan kolom 'jumlah' dan 'jenis' di database Anda
        $totalMasuk = Transaksi::where('jenis', 'masuk')->sum('jumlah') ?? 0;
        $totalKeluar = Transaksi::where('jenis', 'keluar')->sum('jumlah') ?? 0;
        $saldo = $totalMasuk - $totalKeluar;

        // ANGGARAN - Menghitung penyerapan dari total pengeluaran
        $totalAnggaran = Anggaran::sum('jumlah_anggaran') ?? 0;
        $anggaranTerpakai = $totalKeluar;
        $persenAnggaran = $totalAnggaran > 0 
            ? ($anggaranTerpakai / $totalAnggaran) * 100 
            : 0;

        // TRANSAKSI TERBARU
        $transaksiTerbaru = Transaksi::latest()->take(5)->get();

        // GRAFIK BULANAN - Menggunakan kolom 'tanggal' dari tabel Anda
        $grafikBulanan = Transaksi::select(
            DB::raw("MONTH(tanggal) as bulan"),
            DB::raw("SUM(CASE WHEN jenis = 'masuk' THEN jumlah ELSE 0 END) as masuk"),
            DB::raw("SUM(CASE WHEN jenis = 'keluar' THEN jumlah ELSE 0 END) as keluar")
        )
        ->whereYear('tanggal', date('Y'))
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

        // RINGKASAN KATEGORI - Mengelompokkan berdasarkan kolom 'kategori' (Varchar)
        $kategoriSummary = Transaksi::select(
                'kategori',
                DB::raw('SUM(jumlah) as total')
            )
            ->where('jenis', 'keluar')
            ->groupBy('kategori')
            ->get();

        return view('admin.dashboard', [
            'totalMasuk' => $totalMasuk,
            'totalKeluar' => $totalKeluar,
            'saldo' => $saldo,
            'totalAnggaran' => $totalAnggaran,
            'anggaranTerpakai' => $anggaranTerpakai,
            'persenAnggaran' => $persenAnggaran,
            'transaksiTerbaru' => $transaksiTerbaru,
            'grafikBulanan' => $grafikBulanan,
            'kategori' => $kategoriSummary // variabel ini dikirim ke @forelse($kategori as $k) di view
        ]);
    }
}