{{--
    ============================================================
    View: landing/noticias.blade.php
    Descrição: Página pública de notícias — layout estilo portal G1
    Resolve conflito de CSS: usa grid inline para evitar
    sobrescrita do style.css do template original
    ============================================================
--}}
@include('landing.layouts.header')

<body>

    @include('landing.components.navbar')

    {{-- Banner da seção --}}
    <div class="bradcam_area breadcam_bg_sobre_nos">
        <h3>Notícias</h3>
    </div>

    {{-- ════════════════════════════════════════════════════════
     ESTILOS EXCLUSIVOS DESTA PÁGINA
     Prefixados com .pg-noticias para evitar conflitos
     ════════════════════════════════════════════════════════ --}}
    <style>
        /* ── Reset do template dentro desta página ──────────── */
        .pg-noticias {
            background: #f4f5f7;
            padding: 2.5rem 0 4rem;
        }

        /* ── Container centralizado ─────────────────────────── */
        .pg-noticias .pn-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* ── Grid flex — substitui Bootstrap .row/.col ───────── */
        .pn-row {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin: 0 -12px;
        }

        .pn-col-8 {
            width: 66.6667%;
            padding: 0 12px;
            box-sizing: border-box;
        }

        .pn-col-4 {
            width: 33.3333%;
            padding: 0 12px;
            box-sizing: border-box;
        }

        .pn-col-4-card {
            width: 33.3333%;
            padding: 0 12px 28px;
            box-sizing: border-box;
        }

        @media (max-width: 768px) {

            .pn-col-8,
            .pn-col-4,
            .pn-col-4-card {
                width: 100%;
            }
        }

        @media (min-width: 769px) and (max-width: 991px) {
            .pn-col-4-card {
                width: 50%;
            }
        }

        /* ── Cabeçalho editorial de seção ───────────────────── */
        .pn-secao-titulo {
            font-size: 1rem;
            font-weight: 800;
            color: #1a3a5c;
            text-transform: uppercase;
            letter-spacing: .06em;
            border-left: 4px solid #c9a84c;
            padding-left: .6rem;
            margin-bottom: 1.25rem;
        }

        /* ── Destaque principal ──────────────────────────────── */
        .pn-destaque-link {
            display: block;
            text-decoration: none;
            color: inherit;
            border-radius: 6px;
            overflow: hidden;
            position: relative;
        }

        .pn-destaque-link:hover .pn-destaque-img {
            transform: scale(1.03);
        }

        .pn-destaque-img {
            width: 100%;
            height: 420px;
            object-fit: cover;
            display: block;
            transition: transform .35s ease;
        }

        .pn-destaque-sem-foto {
            width: 100%;
            height: 420px;
            background: linear-gradient(135deg, #1a3a5c, #2c5f8a);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pn-destaque-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 2rem 1.5rem 1.5rem;
            background: linear-gradient(to top,
                    rgba(0, 0, 0, .85) 0%,
                    rgba(0, 0, 0, .5) 50%,
                    transparent 100%);
        }

        .pn-destaque-categoria {
            display: inline-block;
            background: #c9a84c;
            color: #fff;
            font-size: .72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .08em;
            padding: .25em .65em;
            border-radius: 3px;
            margin-bottom: .6rem;
        }

        .pn-destaque-titulo {
            font-size: 1.6rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.25;
            margin: 0 0 .5rem;
        }

        .pn-destaque-resumo {
            font-size: .95rem;
            color: rgba(255, 255, 255, .8);
            margin: 0;
            line-height: 1.5;
        }

        .pn-destaque-data {
            font-size: .8rem;
            color: rgba(255, 255, 255, .6);
            margin-top: .5rem;
            display: block;
        }

        /* ── Sidebar de últimas notícias ─────────────────────── */
        .pn-sidebar {
            background: #fff;
            border-radius: 6px;
            padding: 1.25rem;
            height: 100%;
            box-sizing: border-box;
        }

        .pn-sidebar-item {
            display: flex;
            gap: .75rem;
            padding: .85rem 0;
            border-bottom: 1px solid #eee;
            text-decoration: none;
            color: inherit;
            transition: opacity .18s;
        }

        .pn-sidebar-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .pn-sidebar-item:hover {
            opacity: .75;
        }

        .pn-sidebar-thumb {
            width: 88px;
            height: 64px;
            object-fit: cover;
            border-radius: 4px;
            flex-shrink: 0;
        }

        .pn-sidebar-sem-foto {
            width: 88px;
            height: 64px;
            background: #e9ecef;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1.4rem;
            color: #aaa;
        }

        .pn-sidebar-titulo {
            font-size: .88rem;
            font-weight: 700;
            line-height: 1.35;
            color: #1a1a2e;
            margin: 0 0 .3rem;
        }

        .pn-sidebar-data {
            font-size: .76rem;
            color: #999;
        }

        /* ── Separador de seções ─────────────────────────────── */
        .pn-divider {
            border: none;
            border-top: 2px solid #e9ecef;
            margin: 2.5rem 0 2rem;
        }

        /* ── Card de notícia ─────────────────────────────────── */
        .pn-card {
            background: #fff;
            border-radius: 6px;
            overflow: hidden;
            height: 100%;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .07);
            display: flex;
            flex-direction: column;
            transition: transform .22s, box-shadow .22s;
            border-top: 3px solid #1a3a5c;
        }

        .pn-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, .12);
        }

        .pn-card-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }

        .pn-card-sem-foto {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #1a3a5c, #2c5f8a);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: rgba(255, 255, 255, .3);
        }

        .pn-card-body {
            padding: 1.1rem 1.1rem 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .pn-card-categoria {
            font-size: .72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: #c9a84c;
            margin-bottom: .4rem;
        }

        .pn-card-titulo {
            font-size: 1rem;
            font-weight: 700;
            color: #1a1a2e;
            line-height: 1.4;
            margin: 0 0 .6rem;
            flex: 1;
        }

        .pn-card-resumo {
            font-size: .88rem;
            color: #666;
            line-height: 1.5;
            margin-bottom: .9rem;
        }

        .pn-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        .pn-card-data {
            font-size: .78rem;
            color: #aaa;
        }

        .pn-card-link {
            font-size: .85rem;
            font-weight: 700;
            color: #1a3a5c;
            text-decoration: none;
            border-bottom: 1.5px solid #c9a84c;
            padding-bottom: 1px;
            transition: color .18s;
        }

        .pn-card-link:hover {
            color: #c9a84c;
        }

        /* ── Estado vazio ────────────────────────────────────── */
        .pn-vazio {
            text-align: center;
            padding: 3rem 1rem;
            color: #aaa;
        }

        .pn-vazio-icone {
            font-size: 3rem;
            display: block;
            margin-bottom: .75rem;
        }

        /* ── Paginação estilo portal ─────────────────────────── */
        .pn-paginacao {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        .pn-paginacao .pagination {
            gap: .25rem;
        }

        .pn-paginacao .page-link {
            color: #1a3a5c;
            border-color: #dee2e6;
            border-radius: 4px !important;
            padding: .5rem .85rem;
            font-size: .92rem;
        }

        .pn-paginacao .page-item.active .page-link {
            background: #1a3a5c;
            border-color: #1a3a5c;
            color: #fff;
        }

        .pn-paginacao .page-link:hover {
            background: #e8f0fe;
            color: #1a3a5c;
        }
    </style>

    <section class="pg-noticias">
        <div class="pn-container">

            {{-- ════════════════════════════════════════════════
             BLOCO DE DESTAQUE
             Notícia principal + sidebar de últimas
             ════════════════════════════════════════════════ --}}
            @if ($destaque)

                <div class="pn-secao-titulo">
                    &#9670; Em Destaque
                </div>

                {{-- Grid: 2/3 destaque + 1/3 sidebar --}}
                <div class="pn-row" style="margin-bottom: 0">

                    {{-- Notícia destaque principal --}}
                    <div class="pn-col-8">
                        <a href="/noticias/{{ $destaque->slug }}" class="pn-destaque-link">

                            {{-- Imagem ou fallback --}}
                            @if ($destaque->foto_capa)
                                <img src="{{ asset('storage/' . $destaque->foto_capa) }}" class="pn-destaque-img"
                                    alt="{{ $destaque->titulo }}">
                            @else
                                <div class="pn-destaque-sem-foto">
                                    <span style="font-size:4rem;color:rgba(255,255,255,.15)">&#9670;</span>
                                </div>
                            @endif

                            {{-- Sobreposição de texto --}}
                            <div class="pn-destaque-overlay">
                                {{-- Categoria --}}
                                @if ($destaque->categoria)
                                    <span class="pn-destaque-categoria">
                                        {{ $destaque->categoria->nome }}
                                    </span>
                                @endif

                                {{-- Título --}}
                                <h2 class="pn-destaque-titulo">
                                    {{ $destaque->titulo }}
                                </h2>

                                {{-- Resumo --}}
                                @if ($destaque->resumo)
                                    <p class="pn-destaque-resumo">
                                        {{ \Illuminate\Support\Str::limit($destaque->resumo, 130) }}
                                    </p>
                                @else
                                    <p class="pn-destaque-resumo">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($destaque->conteudo), 130) }}
                                    </p>
                                @endif

                                {{-- Data --}}
                                @if ($destaque->publicado_em)
                                    <span class="pn-destaque-data">
                                        &#128197;
                                        {{ $destaque->publicado_em->format('d/m/Y \à\s H\hi') }}
                                    </span>
                                @endif
                            </div>

                        </a>
                    </div>

                    {{-- Sidebar: últimas notícias --}}
                    <div class="pn-col-4">
                        <div class="pn-sidebar">

                            <div class="pn-secao-titulo">
                                &#9670; Últimas Notícias
                            </div>

                            @forelse($ultimas as $u)
                                <a href="/noticias/{{ $u->slug }}" class="pn-sidebar-item">

                                    {{-- Thumbnail --}}
                                    @if ($u->foto_capa)
                                        <img src="{{ asset('storage/' . $u->foto_capa) }}" class="pn-sidebar-thumb"
                                            alt="{{ $u->titulo }}">
                                    @else
                                        <div class="pn-sidebar-sem-foto">&#9670;</div>
                                    @endif

                                    {{-- Texto --}}
                                    <div>
                                        <p class="pn-sidebar-titulo">
                                            {{ \Illuminate\Support\Str::limit($u->titulo, 70) }}
                                        </p>
                                        @if ($u->publicado_em)
                                            <span class="pn-sidebar-data">
                                                {{ $u->publicado_em->format('d/m/Y') }}
                                            </span>
                                        @endif
                                    </div>

                                </a>
                            @empty
                                <p style="color:#aaa;font-size:.9rem">Nenhuma notícia recente.</p>
                            @endforelse

                        </div>
                    </div>

                </div>{{-- fim pn-row destaque --}}

            @endif

            {{-- Divisor entre destaque e grade --}}
            <hr class="pn-divider">

            {{-- ════════════════════════════════════════════════
             GRADE DE NOTÍCIAS — 3 colunas
             ════════════════════════════════════════════════ --}}
            <div class="pn-secao-titulo">
                &#9670; Todas as Notícias
            </div>

            @if ($noticias->count() > 0)

                <div class="pn-row">
                    @foreach ($noticias as $n)
                        <div class="pn-col-4-card">
                            <div class="pn-card">

                                {{-- Imagem ou fallback --}}
                                @if ($n->foto_capa)
                                    <a href="/noticias/{{ $n->slug }}">
                                        <img src="{{ asset('storage/' . $n->foto_capa) }}" class="pn-card-img"
                                            alt="{{ $n->titulo }}">
                                    </a>
                                @else
                                    <a href="/noticias/{{ $n->slug }}" class="pn-card-sem-foto">
                                        &#9670;
                                    </a>
                                @endif

                                {{-- Corpo do card --}}
                                <div class="pn-card-body">

                                    {{-- Categoria --}}
                                    @if ($n->categoria)
                                        <span class="pn-card-categoria">
                                            {{ $n->categoria->nome }}
                                        </span>
                                    @endif

                                    {{-- Título --}}
                                    <h3 class="pn-card-titulo">
                                        <a href="/noticias/{{ $n->slug }}"
                                            style="text-decoration:none;color:inherit">
                                            {{ $n->titulo }}
                                        </a>
                                    </h3>

                                    {{-- Resumo --}}
                                    <p class="pn-card-resumo">
                                        @if ($n->resumo)
                                            {{ \Illuminate\Support\Str::limit($n->resumo, 100) }}
                                        @else
                                            {{ \Illuminate\Support\Str::limit(strip_tags($n->conteudo), 100) }}
                                        @endif
                                    </p>

                                    {{-- Rodapé do card: data + link --}}
                                    <div class="pn-card-footer">
                                        <span class="pn-card-data">
                                            @if ($n->publicado_em)
                                                &#128197; {{ $n->publicado_em->format('d/m/Y') }}
                                            @endif
                                        </span>
                                        <a href="/noticias/{{ $n->slug }}" class="pn-card-link">
                                            Ler mais &rarr;
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Estado vazio --}}
                <div class="pn-vazio">
                    <span class="pn-vazio-icone">&#128240;</span>
                    <p style="font-size:1.1rem">Nenhuma notícia publicada ainda.</p>
                </div>

            @endif

            {{-- Paginação --}}
            @if ($noticias->hasPages())
                <div class="pn-paginacao">
                    {{ $noticias->links() }}
                </div>
            @endif

        </div>{{-- fim pn-container --}}
    </section>

    @include('landing.layouts.footer')
