<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Manajemen Keuangan UKM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        }
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .circle {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #06b6d4);
            filter: blur(80px);
            z-index: -1;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen overflow-x-hidden p-4">

    <div class="circle w-72 h-72 top-[-50px] right-[-20px] opacity-40"></div>
    <div class="circle w-96 h-96 bottom-[-100px] left-[-50px] opacity-20"></div>

    <div class="glass p-8 rounded-2xl shadow-2xl w-full max-w-md">
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600/20 rounded-full mb-4">
                <i class="fas fa-user-plus text-3xl text-blue-500"></i>
            </div>
            <h2 class="text-2xl font-bold text-white">Buat Akun Baru</h2>
            <p class="text-slate-400 text-sm">Mulai kelola keuangan UKM Anda hari ini</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-500/20 border border-red-500/50 text-red-200 p-3 rounded-lg mb-4 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.process') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-slate-300 text-sm mb-1 ml-1">Nama Lengkap</label>
                <div class="relative">
                    <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                    <input type="text" name="name" class="w-full bg-white/10 border border-white/10 rounded-xl px-11 py-2.5 text-white focus:outline-none focus:border-blue-500 transition-all placeholder:text-slate-600" placeholder="Masukkan nama" required>
                </div>
            </div>

            <div>
                <label class="block text-slate-300 text-sm mb-1 ml-1">Alamat Email</label>
                <div class="relative">
                    <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                    <input type="email" name="email" class="w-full bg-white/10 border border-white/10 rounded-xl px-11 py-2.5 text-white focus:outline-none focus:border-blue-500 transition-all placeholder:text-slate-600" placeholder="nama@ukm.com" required>
                </div>
            </div>

            <div>
                <label class="block text-slate-300 text-sm mb-1 ml-1">Password</label>
                <div class="relative">
                    <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                    <input type="password" name="password" class="w-full bg-white/10 border border-white/10 rounded-xl px-11 py-2.5 text-white focus:outline-none focus:border-blue-500 transition-all placeholder:text-slate-600" placeholder="••••••••" required>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-slate-300 text-sm mb-1 ml-1">Konfirmasi Password</label>
                <div class="relative">
                    <i class="fas fa-shield-alt absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                    <input type="password" name="password_confirmation" class="w-full bg-white/10 border border-white/10 rounded-xl px-11 py-2.5 text-white focus:outline-none focus:border-blue-500 transition-all placeholder:text-slate-600" placeholder="Ulangi password" required>
                </div>
            </div>

            <button class="w-full bg-gradient-to-r from-blue-600 to-blue-500 text-white py-3 rounded-xl font-semibold shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-0.5 transition-all active:scale-[0.98]">
                Daftar Sekarang
            </button>
        </form>

        <p class="text-sm text-center mt-6 text-slate-400">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 font-medium ml-1 underline decoration-blue-400/30 underline-offset-4">Login di sini</a>
        </p>
    </div>

</body>
</html>