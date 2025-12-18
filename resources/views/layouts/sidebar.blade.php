<div class="sidebar p-3">
    <h5 class="text-white mb-4">Finance App</h5>

    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard')?'active':'' }}">
                <i class="fas fa-home me-2"></i> Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('transaksi.index') }}" class="nav-link {{ request()->routeIs('transaksi.*')?'active':'' }}">
                <i class="fas fa-exchange-alt me-2"></i> Transaksi
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('anggaran.index') }}" class="nav-link {{ request()->routeIs('anggaran.*')?'active':'' }}">
                <i class="fas fa-wallet me-2"></i> Anggaran
            </a>
        </li>
    </ul>

    {{-- PROFILE --}}
    <div class="profile-box text-center">
        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'User' }}"
             class="rounded-circle mb-2" width="60">
        <div class="fw-semibold">{{ auth()->user()->name ?? 'Admin' }}</div>
        <small class="text-muted">Administrator</small>
    </div>
</div>
