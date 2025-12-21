<div class="sidebar p-3 d-flex flex-column" style="height: 100vh; background-color: #0b1120;">
    
    <h5 class="text-white mb-4">Finance App</h5>

   <div class="profile-box text-center mb-4">
    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'User' }}&background=cbd5e1&color=0f172a"
         class="rounded-circle mb-2" width="50">
    <div class="fw-semibold text-white">{{ auth()->user()->name ?? 'Admin' }}</div>
    
    <small class="text-white">Administrator</small> 
</div>

    <ul class="nav flex-column">
        <li class="nav-item mb-1">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard')?'active':'' }} text-white opacity-75 hover-opacity-100">
                <i class="fas fa-home me-2"></i> Dashboard
            </a>
        </li>

        <li class="nav-item mb-1">
            <a href="{{ route('transaksi.index') }}" class="nav-link {{ request()->routeIs('transaksi.*')?'active':'' }} text-white opacity-75">
                <i class="fas fa-exchange-alt me-2"></i> Transaksi
            </a>
        </li>

        <li class="nav-item mb-1">
            <a href="{{ route('anggaran.index') }}" class="nav-link {{ request()->routeIs('anggaran.*')?'active':'' }} text-white opacity-75">
                <i class="fas fa-wallet me-2"></i> Anggaran
            </a>
        </li>
    </ul>

    <div class="mt-auto pb-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                style="
                    width: 100%;
                    background-color: #0061d4; 
                    color: white; 
                    border: none; 
                    border-radius: 8px; 
                    padding: 10px 16px; 
                    display: flex; 
                    align-items: center; 
                    justify-content: center; 
                    font-family: sans-serif; 
                    font-size: 14px; 
                    font-weight: 600; 
                    cursor: pointer;
                    transition: background 0.2s;
                "
                onmouseover="this.style.backgroundColor='#0052b4'"
                onmouseout="this.style.backgroundColor='#0061d4'">
                
                <svg style="width: 18px; height: 18px; margin-right: 10px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Logout
            </button>
        </form>
    </div>

</div>