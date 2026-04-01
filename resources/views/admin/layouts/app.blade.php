{{--
    ============================================================
    Layout principal do painel administrativo
    ARLS Ferraz de Vasconcelos — CMS Admin

    Características de acessibilidade para público 45+:
    - Fonte base maior (16px → 17px)
    - Botões grandes e coloridos
    - Menu hambúrguer com sidebar recolhível
    - Alto contraste nos textos
    - Ícones grandes e labels visíveis
    - Espaçamento generoso entre elementos
    ============================================================
--}}
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin — ARLS Ferraz de Vasconcelos</title>

    {{-- Bootstrap 5.3 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* ── Variáveis de cor da loja ──────────────────────── */
        :root {
            --arls-azul: #1a3a5c;
            /* Azul maçônico escuro */
            --arls-azul-medio: #2c5f8a;
            /* Azul médio */
            --arls-azul-claro: #e8f0fe;
            /* Azul claro para fundos */
            --arls-dourado: #c9a84c;
            /* Dourado maçônico */
            --arls-sidebar-w: 270px;
            /* Largura da sidebar aberta */
            --arls-topbar-h: 64px;
            /* Altura da barra superior */
        }

        /* ── Reset e base ──────────────────────────────────── */
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            font-size: 17px;
            /* Fonte maior para leitura confortável */
            background: #eef2f7;
            color: #1a1a2e;
            overflow-x: hidden;
        }

        /* ── Barra superior (topbar) ───────────────────────── */
        .topbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--arls-topbar-h);
            background: var(--arls-azul);
            z-index: 1040;
            display: flex;
            align-items: center;
            padding: 0 1.25rem;
            gap: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .3);
        }

        /* Botão hambúrguer — grande para facilitar o toque */
        .btn-hamburger {
            background: none;
            border: none;
            color: #fff;
            font-size: 1.6rem;
            padding: .25rem .5rem;
            cursor: pointer;
            border-radius: 6px;
            transition: background .2s;
            line-height: 1;
        }

        .btn-hamburger:hover {
            background: rgba(255, 255, 255, .15);
        }

        /* Logo na topbar */
        .topbar-logo {
            display: flex;
            align-items: center;
            gap: .6rem;
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
            letter-spacing: .02em;
        }

        .topbar-logo i {
            color: var(--arls-dourado);
            font-size: 1.5rem;
        }

        /* Nome do usuário logado na topbar */
        .topbar-user {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: .6rem;
            color: #cdd8e3;
            font-size: .95rem;
        }

        .topbar-user i {
            font-size: 1.3rem;
        }

        /* ── Sidebar ───────────────────────────────────────── */
        .sidebar {
            position: fixed;
            top: var(--arls-topbar-h);
            left: 0;
            bottom: 0;
            width: var(--arls-sidebar-w);
            background: var(--arls-azul);
            overflow-y: auto;
            overflow-x: hidden;
            transition: transform .28s ease, width .28s ease;
            z-index: 1030;
            padding: 1rem .75rem 1.5rem;
        }

        /* Estado recolhido: move para fora da tela */
        .sidebar.recolhido {
            transform: translateX(calc(-1 * var(--arls-sidebar-w)));
        }

        /* Overlay escuro ao abrir sidebar em telas pequenas */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .45);
            z-index: 1020;
        }

        .sidebar-overlay.visivel {
            display: block;
        }

        /* Seção do menu (título de grupo) */
        .menu-secao {
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: var(--arls-dourado);
            padding: 1.2rem .5rem .4rem;
            margin-top: .25rem;
        }

        .menu-secao:first-child {
            padding-top: .25rem;
        }

        /* Links do menu — grandes e legíveis */
        .sidebar .nav-link {
            color: #cdd8e3;
            border-radius: 8px;
            font-size: 1rem;
            /* Fonte maior para público 45+ */
            font-weight: 500;
            padding: .65rem 1rem;
            display: flex;
            align-items: center;
            gap: .65rem;
            transition: background .18s, color .18s;
            white-space: nowrap;
        }

        .sidebar .nav-link i {
            font-size: 1.2rem;
            /* Ícone maior */
            width: 1.4rem;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, .12);
        }

        .sidebar .nav-link.active {
            color: #fff;
            background: var(--arls-azul-medio);
            box-shadow: inset 3px 0 0 var(--arls-dourado);
        }

        /* Botão de sair no rodapé da sidebar */
        .btn-sair {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            width: 100%;
            padding: .6rem;
            background: rgba(255, 255, 255, .08);
            color: #cdd8e3;
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 8px;
            font-size: .95rem;
            cursor: pointer;
            transition: background .2s, color .2s;
        }

        .btn-sair:hover {
            background: rgba(220, 53, 69, .7);
            color: #fff;
            border-color: transparent;
        }

        /* ── Área de conteúdo principal ────────────────────── */
        .conteudo-principal {
            margin-top: var(--arls-topbar-h);
            margin-left: var(--arls-sidebar-w);
            padding: 1.75rem;
            min-height: calc(100vh - var(--arls-topbar-h));
            transition: margin-left .28s ease;
        }

        /* Quando sidebar está recolhida, conteúdo ocupa tela toda */
        .conteudo-principal.expandido {
            margin-left: 0;
        }

        /* ── Cards ─────────────────────────────────────────── */
        .card {
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .07);
        }

        .card-header {
            border-radius: 12px 12px 0 0 !important;
            font-size: 1rem;
            font-weight: 600;
            padding: .9rem 1.25rem;
        }

        /* ── Tabelas ───────────────────────────────────────── */
        .table {
            font-size: 1rem;
            /* Fonte maior nas tabelas */
        }

        .table th {
            font-size: .85rem;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #6c757d;
        }

        .table td {
            vertical-align: middle;
        }

        /* ── Formulários ───────────────────────────────────── */
        .form-control,
        .form-select {
            font-size: 1rem;
            /* Inputs legíveis */
            padding: .55rem .85rem;
            border-radius: 8px;
        }

        .form-label {
            font-weight: 600;
            font-size: .95rem;
            margin-bottom: .3rem;
            color: #2d3748;
        }

        /* ── Botões — grandes e coloridos ──────────────────── */
        .btn {
            font-size: .97rem;
            padding: .5rem 1.1rem;
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-lg {
            font-size: 1.05rem;
            padding: .65rem 1.4rem;
        }

        .btn-sm {
            font-size: .88rem;
            padding: .35rem .75rem;
        }

        /* Botão primário — azul maçônico */
        .btn-primary {
            background: var(--arls-azul-medio);
            border-color: var(--arls-azul-medio);
        }

        .btn-primary:hover {
            background: var(--arls-azul);
            border-color: var(--arls-azul);
        }

        /* ── Badges ────────────────────────────────────────── */
        .badge {
            font-size: .82rem;
            padding: .4em .65em;
            border-radius: 6px;
        }

        /* ── Alertas de feedback ───────────────────────────── */
        .alert {
            font-size: 1rem;
            border-radius: 10px;
            border: none;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        /* ── Divisor da sidebar ────────────────────────────── */
        .sidebar hr {
            border-color: rgba(255, 255, 255, .15);
            margin: .75rem 0;
        }

        /* ── Responsivo: mobile ────────────────────────────── */
        @media (max-width: 991px) {

            /* Em mobile, sidebar começa recolhida */
            .sidebar {
                transform: translateX(calc(-1 * var(--arls-sidebar-w)));
            }

            .sidebar.aberto {
                transform: translateX(0);
            }

            /* Conteúdo ocupa 100% em mobile */
            .conteudo-principal {
                margin-left: 0 !important;
            }
        }

        /* ── Scrollbar da sidebar ──────────────────────────── */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, .2);
            border-radius: 4px;
        }
    </style>
</head>

<body>

    {{-- ════════════════════════════════════════════════════════
     BARRA SUPERIOR (TOPBAR)
     Sempre visível, contém: hambúrguer, logo e usuário
     ════════════════════════════════════════════════════════ --}}
    <header class="topbar">

        {{-- Botão hambúrguer: recolhe/expande a sidebar --}}
        <button class="btn-hamburger" id="btn-hamburger" title="Abrir/fechar menu"
            aria-label="Abrir ou fechar o menu lateral">
            <i class="bi bi-list"></i>
        </button>

        {{-- Logo e nome do sistema --}}
        <a href="/admin" class="topbar-logo">
            <i class="bi bi-pentagon-fill"></i>
            <span class="d-none d-sm-inline">ARLS Ferraz de Vasconcelos</span>
            <span class="d-inline d-sm-none">ARLS Admin</span>
        </a>

        {{-- Usuário logado — lado direito --}}
        <div class="topbar-user">
            <i class="bi bi-person-circle"></i>
            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
        </div>

    </header>

    {{-- Overlay escuro que fecha a sidebar ao clicar fora (mobile) --}}
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    {{-- ════════════════════════════════════════════════════════
     SIDEBAR — Menu lateral de navegação
     ════════════════════════════════════════════════════════ --}}
    <nav class="sidebar" id="sidebar" aria-label="Menu principal">

        {{-- ── Geral ── --}}
        <div class="menu-secao">Geral</div>
        <ul class="nav flex-column gap-1 mb-1">
            <li class="nav-item">
                <a href="/admin" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
            </li>
        </ul>

        {{-- ── Conteúdo do Site ── --}}
        <div class="menu-secao">Conteúdo do Site</div>
        <ul class="nav flex-column gap-1 mb-1">
            <li class="nav-item">
                <a href="/admin/categorias" class="nav-link {{ request()->is('admin/categorias*') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i>
                    Categorias das Notícias
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/noticias" class="nav-link {{ request()->is('admin/noticias*') ? 'active' : '' }}">
                    <i class="bi bi-newspaper"></i>
                    Notícias
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/galeria" class="nav-link {{ request()->is('admin/galeria*') ? 'active' : '' }}">
                    <i class="bi bi-images"></i>
                    Galeria de Fotos
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/slides" class="nav-link {{ request()->is('admin/slides*') ? 'active' : '' }}">
                    <i class="bi bi-collection-play"></i>
                    Slides do Banner
                </a>
            </li>
        </ul>

        {{-- ── Loja Maçônica ── --}}
        <div class="menu-secao">Loja Maçônica</div>
        <ul class="nav flex-column gap-1 mb-1">
            <li class="nav-item">
                <a href="/admin/membros" class="nav-link {{ request()->is('admin/membros*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    Irmãos Membros
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/sessoes" class="nav-link {{ request()->is('admin/sessoes*') ? 'active' : '' }}">
                    <i class="bi bi-calendar3"></i>
                    Calendário de Sessões
                </a>
            </li>
            {{-- NOVO --}}
            <li class="nav-item">
                <a href="/admin/eventos" class="nav-link {{ request()->is('admin/eventos*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event"></i>
                    Eventos da Loja
                </a>
            </li>
        </ul>

        {{-- ── Sistema ── --}}
        <div class="menu-secao">Sistema</div>
        <ul class="nav flex-column gap-1 mb-3">
            <li class="nav-item">
                <a href="/admin/configuracoes"
                    class="nav-link {{ request()->is('admin/configuracoes*') ? 'active' : '' }}">
                    <i class="bi bi-gear"></i>
                    Configurações
                </a>
            </li>
            <li class="nav-item">
                <a href="/" target="_blank" class="nav-link">
                    <i class="bi bi-box-arrow-up-right"></i>
                    Ver Site Público
                </a>
            </li>
        </ul>

        <hr>

        {{-- Botão de logout --}}
        <form method="POST" action="/admin/logout">
            @csrf
            <button type="submit" class="btn-sair">
                <i class="bi bi-box-arrow-left"></i>
                Sair do Sistema
            </button>
        </form>

    </nav>

    {{-- ════════════════════════════════════════════════════════
     CONTEÚDO PRINCIPAL
     ════════════════════════════════════════════════════════ --}}
    <main class="conteudo-principal" id="conteudo-principal">

        {{-- Alerta de sucesso --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-4"
                role="alert">
                <i class="bi bi-check-circle-fill fs-5"></i>
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        @endif

        {{-- Alerta de erro --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-4"
                role="alert">
                <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                <span>{{ session('error') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        @endif

        {{-- Conteúdo injetado pelas views filhas --}}
        @yield('content')

    </main>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // ────────────────────────────────────────────────────────
        // Controle da Sidebar: hambúrguer, overlay e estado
        // ────────────────────────────────────────────────────────
        const sidebar = document.getElementById('sidebar');
        const conteudo = document.getElementById('conteudo-principal');
        const overlay = document.getElementById('sidebar-overlay');
        const btnHamburger = document.getElementById('btn-hamburger');
        const CHAVE_SIDEBAR = 'arls_sidebar_recolhida'; // Chave no localStorage

        // Verifica se a tela é mobile (largura menor que 992px)
        function isMobile() {
            return window.innerWidth < 992;
        }

        // Aplica o estado correto da sidebar na inicialização
        function inicializarSidebar() {
            if (isMobile()) {
                // Mobile: sempre começa recolhida
                sidebar.classList.remove('aberto', 'recolhido');
                conteudo.classList.add('expandido');
                overlay.classList.remove('visivel');
            } else {
                // Desktop: recupera preferência salva pelo usuário
                const estaRecolhida = localStorage.getItem(CHAVE_SIDEBAR) === 'sim';
                if (estaRecolhida) {
                    sidebar.classList.add('recolhido');
                    conteudo.classList.add('expandido');
                } else {
                    sidebar.classList.remove('recolhido');
                    conteudo.classList.remove('expandido');
                }
            }
        }

        // Alterna a sidebar entre aberta e fechada
        function alternarSidebar() {
            if (isMobile()) {
                // Mobile: usa classe 'aberto' e mostra overlay
                const estaAberta = sidebar.classList.contains('aberto');
                sidebar.classList.toggle('aberto', !estaAberta);
                overlay.classList.toggle('visivel', !estaAberta);
            } else {
                // Desktop: recolhe/expande com animação
                const estaRecolhida = sidebar.classList.contains('recolhido');
                sidebar.classList.toggle('recolhido', !estaRecolhida);
                conteudo.classList.toggle('expandido', !estaRecolhida);
                // Salva a preferência do usuário
                localStorage.setItem(CHAVE_SIDEBAR, estaRecolhida ? 'nao' : 'sim');
            }
        }

        // Fecha a sidebar ao clicar no overlay (mobile)
        function fecharSidebarMobile() {
            sidebar.classList.remove('aberto');
            overlay.classList.remove('visivel');
        }

        // Eventos
        btnHamburger.addEventListener('click', alternarSidebar);
        overlay.addEventListener('click', fecharSidebarMobile);

        // Ajusta ao redimensionar a janela
        window.addEventListener('resize', inicializarSidebar);

        // Inicializa ao carregar a página
        inicializarSidebar();
    </script>

    {{-- Scripts adicionais injetados pelas views filhas --}}
    @stack('scripts')

</body>

</html>
