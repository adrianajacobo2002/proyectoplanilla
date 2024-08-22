<style>
    .profile-avatar {
        background-color: #9dbfbb;
        /* Color verde claro */
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        font-size: 36px;
        color: #2f3e55;
    }

    .navbar-brand {
        font-weight: bold;
        color: #2f3e55;
    }

    .navbar-text {
        color: #2f3e55;
    }

    .navbar .user-info {
        display: flex;
        align-items: center;
    }

    .navbar .user-info .user-details {
        display: flex;
        flex-direction: column;
        margin-right: 10px;
        text-align: right;
    }

    .navbar .user-info .user-details span {
        font-weight: bold;
        color: #2f3e55;
    }

    .navbar .user-info .user-details small {
        color: #2f3e55;
    }

    .navbar .user-info img {
        margin-left: 0;
    }
</style>

<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('contador.dashboard') }}">
            <img src="{{ asset('images/logoContador.png') }}" alt="Logo" width="90px" height="auto">
        </a>
        <div class="d-flex align-items-center">
            <div class="dropdown user-info">
                <a class="d-flex align-items-center" href="#" id="dropdownAvatar" data-bs-toggle="dropdown"
                    aria-expanded="false" style="text-decoration: none;">
                    <div class="user-details">
                        <span>{{ auth()->user()->nombres }}</span>
                        <small>Contador/a</small>
                    </div>
                    <img src="{{ asset('images/avatar.webp') }}" alt="Avatar" class="rounded-circle ms-2"
                        width="50" height="50">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAvatar">
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Cerrar sesión
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
