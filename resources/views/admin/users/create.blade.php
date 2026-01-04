@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-4 text-center text-md-start">
                <h2 class="text-white fw-bold mb-1">Tambah Pengguna</h2>
                <p class="text-secondary">Daftarkan anggota atau pengelola baru ke dalam sistem manajemen.</p>
            </div>

            <div class="card border-0 shadow-lg" style="background-color: #161b22; border-radius: 20px;">
                <div class="card-body p-4 p-md-5">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 rounded-4 shadow-sm mb-4">
                            <ul class="mb-0 small fw-bold">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label text-secondary small fw-bold text-uppercase">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark border-0 text-primary" style="border-radius: 12px 0 0 12px;"><i class="fas fa-user"></i></span>
                                    <input type="text" name="name" class="form-control bg-dark text-white border-0 py-2" 
                                           style="border-radius: 0 12px 12px 0;" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label text-secondary small fw-bold text-uppercase">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark border-0 text-primary" style="border-radius: 12px 0 0 12px;"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control bg-dark text-white border-0 py-2" 
                                           style="border-radius: 0 12px 12px 0;" placeholder="email@ukm.com" value="{{ old('email') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label text-secondary small fw-bold text-uppercase">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark border-0 text-primary" style="border-radius: 12px 0 0 12px;"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control bg-dark text-white border-0 py-2" 
                                           style="border-radius: 0 12px 12px 0;" placeholder="••••••••" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label text-secondary small fw-bold text-uppercase">Konfirmasi Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark border-0 text-primary" style="border-radius: 12px 0 0 12px;"><i class="fas fa-shield-alt"></i></span>
                                    <input type="password" name="password_confirmation" class="form-control bg-dark text-white border-0 py-2" 
                                           style="border-radius: 0 12px 12px 0;" placeholder="••••••••" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label text-secondary small fw-bold text-uppercase">Role / Level</label>
                                <select name="role" class="form-select bg-dark text-white border-0 py-2 shadow-none" style="border-radius: 12px;" required>
                                    <option value="" disabled selected>-- Pilih Role --</option>
                                    <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                                    <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff / Bendahara</option>
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User Umum</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label text-secondary small fw-bold text-uppercase">Nomor Telepon</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark border-0 text-primary" style="border-radius: 12px 0 0 12px;"><i class="fas fa-phone"></i></span>
                                    <input type="text" name="phone" class="form-control bg-dark text-white border-0 py-2" 
                                           style="border-radius: 0 12px 12px 0;" placeholder="0812xxxx" value="{{ old('phone') }}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-5 px-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input bg-dark border-secondary" type="checkbox" name="is_active" id="is_active" checked>
                                <label class="form-check-label text-white ms-2" for="is_active">Aktifkan akun segera setelah dibuat</label>
                            </div>
                        </div>

                        <div class="d-grid gap-3">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold shadow-blue py-3" style="border-radius: 15px; background: linear-gradient(45deg, #0d6efd, #00d4ff); border: none;">
                                <i class="fas fa-user-plus me-2"></i>Simpan Pengguna Baru
                            </button>
                            <a href="{{ route('users.index') }}" class="btn btn-link text-secondary text-decoration-none fw-bold small">
                                Batal & Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body { background-color: #0d1117; }
    .bg-dark { background-color: #0d1117 !important; }
    .text-uppercase { letter-spacing: 1px; }
    .shadow-blue { box-shadow: 0 8px 25px rgba(13, 110, 253, 0.4); }
    .cursor-pointer { cursor: pointer; }
    
    /* Input & Select Focus State */
    input:focus, select:focus, textarea:focus {
        box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.25) !important;
        background-color: #0d1117 !important;
        color: white !important;
    }

    /* Styling select option background */
    select option {
        background-color: #161b22;
        color: white;
    }

    /* Custom Switch Styling */
    .form-check-input:checked {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
    }
</style>
@endsection