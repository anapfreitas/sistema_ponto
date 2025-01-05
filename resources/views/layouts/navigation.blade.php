<nav class="navbar navbar-expand-lg" style="background-color: #23877A;">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand text-white d-flex align-items-center" href="{{ route('dashboard') }}">
            <img src="{{ asset('imgs/logo.png') }}" alt="PontoRural" style="height: 80px; margin-right: 10px;">
            PontoRural
        </a>

        <!-- Botão para dispositivos menores -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links do menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active bg-success' : '' }}" href="{{ route('dashboard') }}">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('users.index') ? 'active bg-success' : '' }}" href="{{ route('users.index') }}">Usuários</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Relatórios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('profile.edit') ? 'active bg-success' : '' }}" href="{{ route('profile.edit') }}">Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Sair
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
