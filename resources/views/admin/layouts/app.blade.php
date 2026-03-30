<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Admin - ARLS Ferraz de Vasconcelos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6fb;
        }

        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: #1a3a5c;
        }

        .sidebar a {
            color: #cdd8e3;
            text-decoration: none;
        }

        .sidebar a:hover,
        .sidebar a.active {
            color: #fff;
            background: rgba(255, 255, 255, .1);
            border-radius: 6px;
        }

        .main-content {
            flex: 1;
            padding: 2rem;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <nav class="sidebar d-flex flex-column p-3">
            <a href="/admin" class="text-white fw-bold mb-4 d-block">ARLS Admin</a>
            <ul class="nav nav-pills flex-column mb-auto gap-1">
                <li><a href="/admin" class="nav-link px-3 py-2"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                </li>
                <li><a href="/admin/noticias" class="nav-link px-3 py-2"><i
                            class="bi bi-newspaper me-2"></i>Noticias</a></li>
                <li><a href="/admin/galeria" class="nav-link px-3 py-2"><i class="bi bi-images me-2"></i>Galeria</a>
                </li>
                <li><a href="/admin/slides" class="nav-link px-3 py-2"><i
                            class="bi bi-collection-play me-2"></i>Slides</a></li>
                <li><a href="/admin/configuracoes" class="nav-link px-3 py-2"><i
                            class="bi bi-gear me-2"></i>Configuracoes</a></li>
            </ul>
            <hr class="border-secondary">
            <form method="POST" action="/admin/logout">
                @csrf
                <button class="btn btn-sm btn-outline-light w-100">
                    <i class="bi bi-box-arrow-left me-1"></i>Sair
                </button>
            </form>
        </nav>
        <main class="main-content">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
