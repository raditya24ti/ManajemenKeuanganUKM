<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Manajemen Keuangan UKM</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            overflow: hidden;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #06b6d4);
            filter: blur(80px);
            z-index: -1;
        }
        .circle-1 { width: 300px; height: 300px; top: -100px; right: -50px; opacity: 0.5; }
        .circle-2 { width: 400px; height: 400px; bottom: -150px; left: -100px; opacity: 0.3; }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        .login-header {
            margin-bottom: 30px;
        }

        .login-header i {
            font-size: 50px;
            color: #3b82f6;
            margin-bottom: 15px;
        }

        .login-header h2 {
            color: white;
            font-weight: 600;
            font-size: 1.5rem;
            letter-spacing: 1px;
        }

        /* Memperbaiki teks keterangan agar terlihat jelas */
        .login-header p {
            color: #cbd5e1;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            color: white;
            outline: none;
            transition: 0.3s;
        }

        .form-group input:focus {
            border-color: #3b82f6;
            background: rgba(255, 255, 255, 0.15);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(90deg, #3b82f6, #2563eb);
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.4);
        }

        .footer-text {
            margin-top: 25px;
            color: #94a3b8;
            font-size: 0.85rem;
        }

        .footer-text a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        /* Style untuk Error Alert */
        .alert-error {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.8rem;
            text-align: left;
        }
    </style>
</head>
<body>

    <div class="circle circle-1"></div>
    <div class="circle circle-2"></div>

    <div class="login-container">
        <div class="login-header">
            <i class="fas fa-wallet"></i>
            <h2>Manajemen UKM</h2>
            <p>Kelola Keuangan Usaha Anda dengan Mudah</p>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    <p><i class="fas fa-exclamation-circle"></i> {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf
            <div class="form-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Alamat Email" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            
            <button type="submit" class="btn-login">Masuk Ke Sistem</button>
        </form>

        <div class="footer-text">
            Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
        </div>
    </div>

</body>
</html>