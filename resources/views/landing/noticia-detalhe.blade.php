{{--
    ============================================================
    View: landing/noticia-detalhe.blade.php
    Descrição: Página de detalhe de notícia — layout estilo jornal
    - Conteúdo centralizado (col-8)
    - Sidebar lateral com outras notícias (col-4)
    - Botão voltar para home e para notícias
    ============================================================
--}}
@include('landing.layouts.header')

<body>

    @include('landing.components.navbar')

    {{-- Banner da seção --}}
    <div class="bradcam_area breadcam_bg_sobre_nos">
        <h3>Notícias</h3>
    </div>

    <style>
        /* ── Estilos exclusivos da página de detalhe ─────────── */
        .nd-wrapper {
            background: #f4f5f7;
            padding: 2.5rem 0 4rem;
        }

        .nd-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* ── Grid flex sem conflitar com o template ──────────── */
        .nd-row {
            display: flex;
            flex-wrap: wrap;
            gap: 28px;
            align-items: flex-start;
        }

        .nd-col-principal {
            flex: 1 1 0;
            min-width: 0;
        }

        .nd-col-sidebar {
            width: 320px;
            flex-shrink: 0;
        }

        @media (max-width: 900px) {
            .nd-row {
                flex-direction: column;
            }

            .nd-col-sidebar {
                width: 100%;
            }
        }

        /* ── Botões de navegação ─────────────────────────────── */
        .nd-nav-bar {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .nd-btn {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .45rem 1rem;
            border-radius: 5px;
            font-size: .88rem;
            font-weight: 600;
            text-decoration: none;
            border: 2px solid transparent;
            transition: background .18s, color .18s, border-color .18s;
            cursor: pointer;
        }

        .nd-btn-home {
            background: #1a3a5c;
            color: #fff;
            border-color: #1a3a5c;
        }

        .nd-btn-home:hover {
            background: #0f2540;
            color: #fff;
        }

        .nd-btn-noticias {
            background: transparent;
            color: #1a3a5c;
            border-color: #1a3a5c;
        }

        .nd-btn-noticias:hover {
            background: #1a3a5c;
            color: #fff;
        }

        /* ── Artigo principal ───────────────────────────────── */
        .nd-artigo {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .07);
        }

        /* Cabeçalho do artigo */
        .nd-artigo-header {
            padding: 2rem 2rem 1.25rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .nd-artigo-categoria {
            display: inline-block;
            background: #c9a84c;
            color: #fff;
            font-size: .72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .08em;
            padding: .25em .7em;
            border-radius: 3px;
            margin-bottom: .75rem;
        }

        .nd-artigo-titulo {
            font-size: 1.75rem;
            font-weight: 800;
            color: #1a1a2e;
            line-height: 1.3;
            margin: 0 0 1rem;
        }

        .nd-artigo-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.25rem;
            align-items: center;
            font-size: .83rem;
            color: #888;
        }

        .nd-artigo-meta span {
            display: flex;
            align-items: center;
            gap: .3rem;
        }

        .nd-artigo-meta strong {
            color: #555;
        }

        /* Imagem de capa */
        .nd-artigo-capa {
            width: 100%;
            max-height: 480px;
            object-fit: cover;
            display: block;
        }

        .nd-artigo-capa-legenda {
            font-size: .78rem;
            color: #aaa;
            text-align: center;
            padding: .4rem 1rem;
            background: #fafafa;
            border-bottom: 1px solid #f0f0f0;
        }

        /* Conteúdo do artigo */
        .nd-artigo-conteudo {
            padding: 1.75rem 2rem 2rem;
            font-size: 1.05rem;
            line-height: 1.8;
            color: #333;
        }

        .nd-artigo-conteudo p {
            margin-bottom: 1.2rem;
        }

        .nd-artigo-conteudo h2,
        .nd-artigo-conteudo h3 {
            color: #1a3a5c;
            margin: 1.5rem 0 .75rem;
        }

        .nd-artigo-conteudo img {
            max-width: 100%;
            border-radius: 6px;
            margin: 1rem 0;
        }

        .nd-artigo-conteudo blockquote {
            border-left: 4px solid #c9a84c;
            padding: .75rem 1.25rem;
            margin: 1.5rem 0;
            background: #faf7f0;
            color: #555;
            font-style: italic;
            border-radius: 0 6px 6px 0;
        }

        /* Rodapé do artigo: compartilhar + voltar */
        .nd-artigo-rodape {
            padding: 1.25rem 2rem;
            border-top: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            background: #fafafa;
        }

        .nd-compartilhar {
            display: flex;
            align-items: center;
            gap: .6rem;
            font-size: .85rem;
            color: #888;
        }

        .nd-share-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            text-decoration: none;
            font-size: 1rem;
            transition: opacity .18s;
        }

        .nd-share-btn:hover {
            opacity: .8;
        }

        .nd-share-fb {
            background: #1877f2;
            color: #fff;
        }

        .nd-share-tw {
            background: #1da1f2;
            color: #fff;
        }

        .nd-share-wa {
            background: #25d366;
            color: #fff;
        }

        /* ── Sidebar ─────────────────────────────────────────── */
        .nd-sidebar-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .07);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .nd-sidebar-header {
            padding: .85rem 1.1rem;
            background: #1a3a5c;
            color: #fff;
            font-size: .88rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .07em;
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .nd-sidebar-header span {
            color: #c9a84c;
        }

        /* Item de notícia na sidebar */
        .nd-sidebar-item {
            display: flex;
            gap: .75rem;
            padding: .85rem 1.1rem;
            border-bottom: 1px solid #f0f0f0;
            text-decoration: none;
            color: inherit;
            transition: background .15s;
        }

        .nd-sidebar-item:last-child {
            border-bottom: none;
        }

        .nd-sidebar-item:hover {
            background: #f8f9fa;
        }

        .nd-sidebar-item.nd-item-ativo {
            background: #e8f0fe;
            border-left: 3px solid #1a3a5c;
        }

        .nd-sidebar-thumb {
            width: 72px;
            height: 54px;
            object-fit: cover;
            border-radius: 4px;
            flex-shrink: 0;
        }

        .nd-sidebar-sem-foto {
            width: 72px;
            height: 54px;
            background: #e9ecef;
            border-radius: 4px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #bbb;
            font-size: 1.2rem;
        }

        .nd-sidebar-item-titulo {
            font-size: .86rem;
            font-weight: 700;
            color: #1a1a2e;
            line-height: 1.35;
            margin: 0 0 .25rem;
        }

        .nd-sidebar-item.nd-item-ativo .nd-sidebar-item-titulo {
            color: #1a3a5c;
        }

        .nd-sidebar-item-data {
            font-size: .75rem;
            color: #aaa;
        }

        /* Card de links rápidos na sidebar */
        .nd-sidebar-links {
            padding: .5rem 0;
        }

        .nd-sidebar-link {
            display: flex;
            align-items: center;
            gap: .6rem;
            padding: .7rem 1.1rem;
            text-decoration: none;
            color: #1a3a5c;
            font-size: .9rem;
            font-weight: 600;
            border-bottom: 1px solid #f0f0f0;
            transition: background .15s;
        }

        .nd-sidebar-link:last-child {
            border-bottom: none;
        }

        .nd-sidebar-link:hover {
            background: #f0f4f8;
            color: #1a3a5c;
        }

        .nd-sidebar-link-icone {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .95rem;
            flex-shrink: 0;
        }
    </style>

    <section class="nd-wrapper">
        <div class="nd-container">

            {{-- ── Barra de navegação superior ── --}}
            <nav class="nd-nav-bar">
                <a href="/" class="nd-btn nd-btn-home">
                    &#8962; Página Inicial
                </a>
                <a href="/noticias" class="nd-btn nd-btn-noticias">
                    &#10094; Todas as Notícias
                </a>
                @if ($noticia->categoria)
                    <span style="font-size:.85rem;color:#aaa">
                        &#9670; {{ $noticia->categoria->nome }}
                    </span>
                @endif
            </nav>

            {{-- ── Layout principal: artigo + sidebar ── --}}
            <div class="nd-row">

                {{-- ════════════════════════════════════════════
                 COLUNA PRINCIPAL — Artigo completo
                 ════════════════════════════════════════════ --}}
                <div class="nd-col-principal">
                    <article class="nd-artigo">

                        {{-- Cabeçalho: categoria, título, meta --}}
                        <header class="nd-artigo-header">

                            {{-- Categoria --}}
                            @if ($noticia->categoria)
                                <span class="nd-artigo-categoria">
                                    {{ $noticia->categoria->nome }}
                                </span>
                            @endif

                            {{-- Título principal --}}
                            <h1 class="nd-artigo-titulo">
                                {{ $noticia->titulo }}
                            </h1>

                            {{-- Meta: data e autor --}}
                            <div class="nd-artigo-meta">
                                <span>
                                    &#128197;
                                    Publicado em
                                    <strong>
                                        {{ ($noticia->publicado_em ?? $noticia->created_at)->format('d/m/Y') }}
                                    </strong>
                                </span>
                                @if ($noticia->autor)
                                    <span>
                                        &#9998;
                                        Por <strong>{{ $noticia->autor->name }}</strong>
                                    </span>
                                @endif
                            </div>

                        </header>

                        {{-- Foto de capa --}}
                        @if ($noticia->foto_capa)
                            <img src="{{ asset('storage/' . $noticia->foto_capa) }}" class="nd-artigo-capa"
                                alt="{{ $noticia->titulo }}">
                            <p class="nd-artigo-capa-legenda">
                                {{ $noticia->titulo }} — ARLS Ferraz de Vasconcelos
                            </p>
                        @endif

                        {{-- Conteúdo HTML do editor --}}
                        <div class="nd-artigo-conteudo">
                            {!! $noticia->conteudo !!}
                        </div>

                        {{-- Rodapé: compartilhar --}}
                        <footer class="nd-artigo-rodape">

                            <div class="nd-compartilhar">
                                <span>Compartilhar:</span>

                                {{-- Facebook --}}

                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('/noticias/' . $noticia->slug)) }}"
                                target="_blank"
                                class="nd-share-btn nd-share-fb"
                                title="Compartilhar no Facebook"
                                >f</a>

                                {{-- Twitter/X --}}

                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url('/noticias/' . $noticia->slug)) }}&text={{ urlencode($noticia->titulo) }}"
                                target="_blank"
                                class="nd-share-btn nd-share-tw"
                                title="Compartilhar no Twitter"
                                >&#120143;</a>

                                {{-- WhatsApp --}}

                                <a href="https://wa.me/?text={{ urlencode($noticia->titulo . ' ' . url('/noticias/' . $noticia->slug)) }}"
                                target="_blank"
                                class="nd-share-btn nd-share-wa"
                                title="Compartilhar no WhatsApp"
                                >&#128172;</a>
                            </div>

                            {{-- Botão voltar --}}
                            <a href="/noticias" class="nd-btn nd-btn-noticias">
                                &#10094; Voltar para Notícias
                            </a>

                        </footer>

                    </article>
                </div>{{-- fim nd-col-principal --}}

                {{-- ════════════════════════════════════════════
                 SIDEBAR — Links rápidos + outras notícias
                 ════════════════════════════════════════════ --}}
                <aside class="nd-col-sidebar">

                    {{-- Card: Navegação rápida --}}
                    <div class="nd-sidebar-card">
                        <div class="nd-sidebar-header">
                            <span>&#9670;</span> Navegação
                        </div>
                        <div class="nd-sidebar-links">
                            <a href="/" class="nd-sidebar-link">
                                <span class="nd-sidebar-link-icone" style="background:#e8f0fe;color:#1a3a5c">
                                    &#8962;
                                </span>
                                Página Inicial
                            </a>
                            <a href="/noticias" class="nd-sidebar-link">
                                <span class="nd-sidebar-link-icone" style="background:#e8f0fe;color:#1a3a5c">
                                    &#128240;
                                </span>
                                Todas as Notícias
                            </a>
                            <a href="/galeria" class="nd-sidebar-link">
                                <span class="nd-sidebar-link-icone" style="background:#e6f4ea;color:#2e7d32">
                                    &#128247;
                                </span>
                                Galeria de Fotos
                            </a>
                            <a href="/sobre-nos" class="nd-sidebar-link">
                                <span class="nd-sidebar-link-icone" style="background:#fff3e0;color:#e65100">
                                    &#9670;
                                </span>
                                Sobre a Loja
                            </a>
                            <a href="/maconaria" class="nd-sidebar-link">
                                <span class="nd-sidebar-link-icone" style="background:#f3e5f5;color:#7b1fa2">
                                    &#9670;
                                </span>
                                O que é Maçonaria?
                            </a>
                        </div>
                    </div>

                    {{-- Card: Outras notícias --}}
                    @php
                        // Busca outras notícias publicadas, excluindo a atual
                        $outrasNoticias = \App\Models\Noticia::where('publicado', true)
                            ->where('id', '!=', $noticia->id)
                            ->latest('publicado_em')
                            ->take(6)
                            ->get();
                    @endphp

                    @if ($outrasNoticias->count() > 0)
                        <div class="nd-sidebar-card">
                            <div class="nd-sidebar-header">
                                <span>&#9670;</span> Outras Notícias
                            </div>

                            @foreach ($outrasNoticias as $outra)
                                <a href="/noticias/{{ $outra->slug }}"
                                class="nd-sidebar-item"
                                >
                                {{-- Thumbnail --}}
                                @if ($outra->foto_capa)
                                    <img src="{{ asset('storage/' . $outra->foto_capa) }}" class="nd-sidebar-thumb"
                                        alt="{{ $outra->titulo }}">
                                @else
                                    <div class="nd-sidebar-sem-foto">&#9670;</div>
                                @endif

                                {{-- Título e data --}}
                                <div>
                                    <p class="nd-sidebar-item-titulo">
                                        {{ \Illuminate\Support\Str::limit($outra->titulo, 65) }}
                                    </p>
                                    @if ($outra->publicado_em)
                                        <span class="nd-sidebar-item-data">
                                            &#128197; {{ $outra->publicado_em->format('d/m/Y') }}
                                        </span>
                                    @endif
                                </div>
                                </a>
                            @endforeach

                        </div>
                    @endif

                </aside>{{-- fim nd-col-sidebar --}}

            </div>{{-- fim nd-row --}}

        </div>{{-- fim nd-container --}}
    </section>

    @include('landing.layouts.footer')
