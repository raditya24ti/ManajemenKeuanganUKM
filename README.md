# Sistem Manajemen Keuangan UKM

Sistem manajemen keuangan lengkap untuk UKM (Usaha Kecil Menengah) dengan berbagai fitur untuk mengelola keuangan organisasi.

## Fitur Utama

### 1. Dashboard Keuangan
- Ringkasan saldo, pemasukan, dan pengeluaran
- Grafik pemasukan & pengeluaran bulanan
- Statistik cepat (penggunaan anggaran, pengajuan pending, iuran terlambat)
- Transaksi terbaru

### 2. Pencatatan Transaksi
- Input pemasukan & pengeluaran
- Kategori transaksi
- Tanggal dan keterangan lengkap
- Filter berdasarkan tipe, kategori, dan tanggal
- Status transaksi (pending, completed, cancelled)

### 3. Manajemen Anggaran
- Perencanaan budget kegiatan
- Perbandingan anggaran vs realisasi
- Tracking penggunaan anggaran
- Status anggaran (draft, active, completed, cancelled)

### 4. Laporan Keuangan
- Laporan transaksi
- Laporan arus kas
- Laporan anggaran
- Laporan iuran anggota
- Export PDF/Excel (placeholder - perlu library tambahan)

### 5. Manajemen Pengguna & Hak Akses
- 4 level akses: Ketua, Bendahara, Pengurus, Anggota
- Manajemen user (hanya ketua & bendahara)
- Role-based access control

### 6. Pengajuan & Persetujuan Dana
- Alur pengajuan dana kegiatan
- Approval system (ketua & bendahara)
- Link ke anggaran
- Notifikasi otomatis

### 7. Iuran Anggota
- Pencatatan iuran per periode
- Tracking pembayaran
- Status iuran (pending, paid, overdue, waived)
- Auto-create transaksi saat pembayaran

### 8. Dokumen & Bukti Transaksi
- Upload nota, proposal, bukti pembayaran
- Polimorfik relationship (dapat diattach ke transaksi, pengajuan, iuran, anggaran)
- Download dokumen

### 9. Notifikasi & Reminder
- Notifikasi pengajuan dana
- Reminder iuran
- Notifikasi approval/rejection
- Badge unread count

### 10. Audit Trail / Riwayat Aktivitas
- Catatan semua perubahan data
- Tracking user, action, dan timestamp
- Old values & new values
- IP address & user agent

## Instalasi

1. Clone repository atau extract project
2. Install dependencies:
```bash
composer install
npm install
```

3. Setup environment:
```bash
cp .env.example .env
php artisan key:generate
```

4. Konfigurasi database di `.env`

5. Jalankan migrations dan seeders:
```bash
php artisan migrate
php artisan db:seed
```

6. Buat symbolic link untuk storage:
```bash
php artisan storage:link
```

7. Jalankan server:
```bash
php artisan serve
```

## Default Login

Setelah menjalankan seeder, gunakan akun berikut:

- **Ketua**: ketua@ukm.com / password
- **Bendahara**: bendahara@ukm.com / password
- **Pengurus**: pengurus@ukm.com / password
- **Anggota**: anggota1@ukm.com / password

## Struktur Database

### Tabel Utama:
- `users` - Data pengguna dengan role
- `categories` - Kategori transaksi
- `transactions` - Transaksi keuangan
- `budgets` - Anggaran kegiatan
- `fund_requests` - Pengajuan dana
- `member_dues` - Iuran anggota
- `documents` - Dokumen/bukti transaksi
- `notifications` - Notifikasi sistem
- `audit_trails` - Riwayat aktivitas

## Teknologi

- Laravel 12
- Bootstrap 5
- Chart.js (untuk grafik)
- Font Awesome (icons)

## Catatan Pengembangan

### Export PDF/Excel
Fitur export PDF dan Excel masih placeholder. Untuk implementasi lengkap, install:
- **PDF**: `barryvdh/laravel-dompdf` atau `spatie/laravel-pdf`
- **Excel**: `maatwebsite/excel`

Contoh instalasi:
```bash
composer require barryvdh/laravel-dompdf
composer require maatwebsite/excel
```

### Notifikasi Real-time
Untuk notifikasi real-time, pertimbangkan menggunakan Laravel Echo + Pusher/Broadcasting.

### File Storage
Pastikan folder `storage/app/public/documents` writable untuk upload dokumen.

## Lisensi

Project ini dibuat untuk keperluan UKM.
