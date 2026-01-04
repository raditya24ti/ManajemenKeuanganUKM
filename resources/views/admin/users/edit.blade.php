@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
    <div class="container py-5">
        <div class="mb-4">
            <h2 class="text-white font-weight-bold">Edit Pengguna</h2>
            <p class="text-secondary" style="color: #8b949e !important;">Perbarui identitas dan hak akses pengguna untuk
                kendali sistem yang lebih baik.</p>
        </div>

        <div class="card shadow-lg border-0" style="background-color: #1a1e26; border-radius: 15px;">
            <div class="card-body p-4 p-md-5">

                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="text-uppercase small font-weight-bold mb-2"
                                style="color: #8b949e !important;">NAMA LENGKAP <span class="text-danger">*</span></label>
                            <input type="text" name="name"
                                class="form-control custom-input @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}" placeholder="Contoh: Raditya" required>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="text-uppercase small font-weight-bold mb-2"
                                style="color: #8b949e !important;">EMAIL <span class="text-danger">*</span></label>
                            <input type="email" name="email"
                                class="form-control custom-input @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}" placeholder="admin@example.com" required>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="text-uppercase small font-weight-bold mb-2"
                                style="color: #8b949e !important;">PASSWORD BARU (Opsional)</label>
                            <input type="password" name="password"
                                class="form-control custom-input @error('password') is-invalid @enderror"
                                placeholder="••••••••">
                            <small class="text-muted italic">Kosongkan jika tidak ingin mengubah password.</small>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="text-uppercase small font-weight-bold mb-2"
                                style="color: #8b949e !important;">KONFIRMASI PASSWORD BARU</label>
                            <input type="password" name="password_confirmation" class="form-control custom-input"
                                placeholder="••••••••">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="text-uppercase small font-weight-bold mb-2"
                                style="color: #8b949e !important;">ROLE <span class="text-danger">*</span></label>
                            <select name="role" class="form-select custom-input @error('role') is-invalid @enderror"
                                required>
                                <option value="superadmin"
                                    {{ old('role', $user->role) === 'superadmin' ? 'selected' : '' }}>SuperAdmin</option>
                                <option value="staff" {{ old('role', $user->role) === 'staff' ? 'selected' : '' }}>Staff
                                </option>
                                <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User
                                </option>
                            </select>
                            @error('role')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="text-uppercase small font-weight-bold mb-2"
                                style="color: #8b949e !important;">NOMOR TELEPON</label>
                            <input type="text" name="phone" class="form-control custom-input"
                                value="{{ old('phone', $user->phone) }}" placeholder="0812xxxx">
                        </div>
                    </div>

                    <div class="mb-5 px-1">
                        <div class="form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" id="is_active"
                                {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                                style="background-color: #12151c; border-color: #2d333b;">
                            <label class="form-check-label text-white small" for="is_active">Status Akun Aktif</label>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-cyan btn-block font-weight-bold py-3">
                            <i class="fas fa-sync-alt mr-2"></i> Perbarui Data Pengguna
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('users.index') }}" class="text-secondary small font-weight-bold"
                            style="text-decoration: none;">Batal & Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Kostumisasi CSS agar identik dengan Tambah Anggaran */
        body {
            background-color: #0d1117;
        }

        .custom-input {
            background-color: #12151c !important;
            border: 1px solid #2d333b !important;
            color: #ffffff !important;
            border-radius: 8px;
            padding: 12px 15px;
        }

        .custom-input::placeholder {
            color: #4b5563 !important;
        }

        .custom-input:focus {
            border-color: #00e5ff !important;
            box-shadow: 0 0 8px rgba(0, 229, 255, 0.2);
            background-color: #12151c !important;
            color: white !important;
        }

        /* Dropdown Styling */
        select.custom-input option {
            background-color: #1a1e26;
            color: white;
        }

        /* Tombol Cyan Neon */
        .btn-cyan {
            background-color: #00e5ff;
            color: #000;
            border: none;
            border-radius: 10px;
            width: 100%;
            box-shadow: 0 4px 15px rgba(0, 229, 255, 0.3);
            transition: all 0.3s;
        }

        .btn-cyan:hover {
            background-color: #00d4ec;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 229, 255, 0.5);
        }

        /* Checkbox styling */
        .form-check-input:checked {
            background-color: #00e5ff !important;
            border-color: #00e5ff !important;
        }

        .text-secondary {
            color: #8b949e !important;
        }
    </style>
@endsection
