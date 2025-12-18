<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Anggaran;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // TOTAL
        $totalMasuk = Transaksi::where('jenis', 'masuk')->sum('jumlah');
        $totalKeluar = Transaksi::where('jenis', 'keluar')->sum('jumlah');
        $saldo = $totalMasuk - $totalKeluar;

        // ANGGARAN
        $totalAnggaran = Anggaran::sum('jumlah_anggaran');
        $anggaranTerpakai = Transaksi::where('jenis', 'keluar')->sum('jumlah');
        $persenAnggaran = $totalAnggaran > 0
            ? ($anggaranTerpakai / $totalAnggaran) * 100
            : 0;

        // TRANSAKSI TERBARU
        $transaksiTerbaru = Transaksi::latest()->take(5)->get();

        // GRAFIK BULANAN
       $grafikBulanan = Transaksi::select(
        DB::raw("MONTH(tanggal) as bulan"),
        DB::raw("SUM(CASE WHEN jenis = 'masuk' THEN jumlah ELSE 0 END) as masuk"),
        DB::raw("SUM(CASE WHEN jenis = 'keluar' THEN jumlah ELSE 0 END) as keluar")
    )
    ->groupBy('bulan')
    ->orderBy('bulan')
    ->get();
        // RINGKASAN KATEGORI
        $kategori = Transaksi::select(
                'kategori',
                DB::raw('SUM(jumlah) as total')
            )
            ->where('jenis', 'keluar')
            ->groupBy('kategori')
            ->get();

        return view('admin.dashboard', compact(
            'totalMasuk',
            'totalKeluar',
            'saldo',
            'totalAnggaran',
            'anggaranTerpakai',
            'persenAnggaran',
            'transaksiTerbaru',
            'grafikBulanan',
            'kategori'
        ));
    }
}
