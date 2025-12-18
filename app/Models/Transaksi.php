<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    // Nama tabel (karena bukan plural default Laravel)
    protected $table = 'transaksi';

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'tanggal',
        'jenis',
        'kategori',
        'jumlah',
        'keterangan'
    ];
}
