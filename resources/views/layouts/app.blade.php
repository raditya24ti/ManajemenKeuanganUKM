<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Manajemen Keuangan UKM')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- CSS CUSTOM --}}
    <style>
        :root{
            --bg-main:#f8fafc;
            --bg-card:#ffffff;
            --bg-sidebar:#0f172a;
            --border:#e5e7eb;
            --text:#111827;
            --text-muted:#6b7280;
            --primary:#2563eb;
        }

        body{
            background:var(--bg-main);
            font-family:'Inter',system-ui,sans-serif;
            color:var(--text);
        }

        /* SIDEBAR */
        .sidebar{
            width:260px;
            min-height:100vh;
            background:var(--bg-sidebar);
            position:fixed;
            top:0;
            left:0;
            padding:20px;
        }

        .sidebar h5{
            color:#fff;
            margin-bottom:20px;
        }

        .sidebar .nav-link{
            color:#cbd5f5;
            padding:10px 14px;
            border-radius:10px;
            margin-bottom:6px;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover{
            background:rgba(37,99,235,.25);
            color:#fff;
        }

        /* CONTENT */
        .content{
            margin-left:260px;
            min-height:100vh;
        }

        /* NAVBAR */
        .topbar{
            background:#fff;
            border-bottom:1px solid var(--border);
            padding:14px 24px;
        }

        /* MAIN */
        .main{
            padding:28px;
        }

        /* CARD */
        .card{
            background:var(--bg-card);
            border:1px solid var(--border);
            border-radius:16px;
        }

        .card-header{
            background:transparent;
            border-bottom:1px solid var(--border);
            font-weight:600;
        }

        /* ICON */
        .icon-box{
            width:42px;
            height:42px;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:12px;
            background:rgba(37,99,235,.15);
            color:var(--primary);
        }

        canvas{
            max-height:280px;
        }
    </style>

    @stack('styles')
</head>
<body>

{{-- SIDEBAR --}}
@include('layouts.sidebar')

{{-- CONTENT --}}
<div class="content">

    {{-- NAVBAR --}}
    <div class="topbar d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Dashboard</h6>
        <div>
            <i class="fas fa-user-circle me-1"></i> Admin
        </div>
    </div>

    {{-- MAIN --}}
    <div class="main">
        @yield('content')
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
