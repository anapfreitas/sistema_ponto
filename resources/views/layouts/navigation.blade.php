<nav class="navbar navbar-expand-lg" style="background-color: #23877A;">
    <div class="container-fluid">

        <a class="navbar-brand text-white d-flex align-items-center" href="{{ route('dashboard') }}">
            <img src="{{ asset('imgs/logo.png') }}" alt="PontoRural" style="height: 80px; margin-right: 10px;">
            PontoRural
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active bg-success' : '' }}" href="{{ route('dashboard') }}">Início</a>
                </li>

                @role('admin')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white {{ request()->is('users*') ? 'active bg-success' : '' }}" href="#" id="navbarDropdownUsers" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Usuários
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownUsers">
                        <li><a class="dropdown-item" href="{{ route('users.index') }}">Listar Usuários</a></li>
                        <li><a class="dropdown-item" href="{{ route('users.create') }}">Criar Usuário</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white {{ request()->is('funcionarios*') ? 'active bg-success' : '' }}" href="#" id="navbarDropdownFuncionarios" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Funcionários
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownFuncionarios">
                        <li><a class="dropdown-item" href="{{ route('funcionarios.index') }}">Listar Funcionários</a></li>
                        <li><a class="dropdown-item" href="{{ route('funcionarios.create') }}">Cadastrar Funcionário</a></li>
                    </ul>
                </li>
                @endrole

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