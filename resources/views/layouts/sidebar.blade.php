<div class="sidebar p-3 d-flex flex-column" style="height: 100vh; background-color: #0b1120;">

    {{-- ================= PROFILE ================= --}}
    <h5 class="text-white mb-4">Profile</h5>

    @auth
        <div class="profile-box text-center mb-4">
            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=cbd5e1&color=0f172a"
                 class="rounded-circle mb-2" width="50">
            <div class="fw-semibold text-white">
                {{ auth()->user()->name }}
            </div>
            <small class="text-secondary">{{ ucfirst(auth()->user()->role) }}</small>
        </div>
    @endauth

    @guest
        <div class="profile-box text-center mb-4">
            <img src="https://ui-avatars.com/api/?name=Guest&background=cbd5e1&color=0f172a"
                 class="rounded-circle mb-2" width="50">
            <div class="fw-semibold text-white">Guest</div>
        </div>
    @endguest

    {{-- ================= MENU ================= --}}
    <ul class="nav flex-column">

        <li class="nav-item mb-1">
            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard')?'active':'' }} text-white opacity-75">
                <i class="fas fa-home me-2"></i> Dashboard
            </a>
        </li>


        @auth
            <li class="nav-item mb-1">
                <a href="{{ route('transaksi.index') }}"
                   class="nav-link {{ request()->routeIs('transaksi.*')?'active':'' }} text-white opacity-75">
                    <i class="fas fa-exchange-alt me-2"></i> Transaksi
                </a>
            </li>

            <li class="nav-item mb-1">
                <a href="{{ route('anggaran.index') }}"
                   class="nav-link {{ request()->routeIs('anggaran.*')?'active':'' }} text-white opacity-75">
                    <i class="fas fa-wallet me-2"></i> Anggaran
                </a>
            </li>

            {{-- 🔐 ADMIN ONLY --}}
            @if(auth()->user()->role === 'staff' || auth()->user()->role === 'superadmin')
                <li class="nav-item mb-1">
                    <a href="{{ route('users.index') }}"
                       class="nav-link {{ request()->routeIs('users.*')?'active':'' }} text-white opacity-75">
                        <i class="fas fa-user me-2"></i> Users
                    </a>
                </li>
            @endif
        @endauth

    </ul>

    {{-- ================= LOGIN / LOGOUT ================= --}}
    <div class="mt-auto pb-4">

        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="btn w-100"
                        style="background-color:#0061d4;color:white;border-radius:8px;">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}"
               class="btn w-100"
               style="background-color:#0061d4;color:white;border-radius:8px;">
                <i class="fas fa-sign-in-alt me-2"></i> Login
            </a>
        @endguest

    </div>
</div>
