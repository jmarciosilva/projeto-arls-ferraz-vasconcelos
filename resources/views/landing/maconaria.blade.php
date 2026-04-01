{{--
    ============================================================
    View: landing/maconaria.blade.php
    Descrição: O que é Maçonaria — layout padrão institucional
    ============================================================
--}}
@include('landing.layouts.header')

<body>
    @include('landing.components.navbar')

    <div class="bradcam_area breadcam_bg"></div>

    <style>
        .nd-wrapper {
            background: #f4f5f7;
            padding: 2.5rem 0 4rem
        }

        .nd-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px
        }

        .nd-row {
            display: flex;
            flex-wrap: wrap;
            gap: 28px;
            align-items: flex-start
        }

        .nd-col-principal {
            flex: 1 1 0;
            min-width: 0
        }

        .nd-col-sidebar {
            width: 320px;
            flex-shrink: 0
        }

        @media(max-width:900px) {
            .nd-row {
                flex-direction: column
            }

            .nd-col-sidebar {
                width: 100%
            }
        }

        .nd-nav-bar {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap
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
            transition: background .18s, color .18s
        }

        .nd-btn-home {
            background: #1a3a5c;
            color: #fff;
            border-color: #1a3a5c
        }

        .nd-btn-home:hover {
            background: #0f2540;
            color: #fff
        }

        .nd-btn-voltar {
            background: transparent;
            color: #1a3a5c;
            border-color: #1a3a5c
        }

        .nd-btn-voltar:hover {
            background: #1a3a5c;
            color: #fff
        }

        .nd-artigo {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .07)
        }

        .nd-artigo-header {
            padding: 2rem 2rem 1.5rem;
            border-bottom: 1px solid #f0f0f0
        }

        .nd-artigo-badge {
            display: inline-block;
            background: #c9a84c;
            color: #fff;
            font-size: .72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .08em;
            padding: .25em .7em;
            border-radius: 3px;
            margin-bottom: .75rem
        }

        .nd-artigo-titulo {
            font-size: 1.75rem;
            font-weight: 800;
            color: #1a1a2e;
            line-height: 1.3;
            margin: 0 0 1rem;
            border-left: 5px solid #c9a84c;
            padding-left: .85rem
        }

        .nd-artigo-conteudo {
            padding: 1.75rem 2rem 2rem;
            font-size: 1.05rem;
            line-height: 1.85;
            color: #333
        }

        .nd-artigo-conteudo p {
            margin-bottom: 1.25rem
        }

        .nd-artigo-conteudo h3 {
            font-size: 1.2rem;
            font-weight: 800;
            color: #1a3a5c;
            border-left: 4px solid #c9a84c;
            padding-left: .65rem;
            margin: 2rem 0 .75rem;
            text-transform: uppercase;
            letter-spacing: .04em
        }

        .nd-artigo-conteudo ol {
            padding-left: 1.25rem;
            margin-bottom: 1.25rem
        }

        .nd-artigo-conteudo ol li {
            margin-bottom: .5rem;
            line-height: 1.7
        }

        .nd-artigo-rodape {
            padding: 1.25rem 2rem;
            border-top: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            background: #fafafa
        }

        .nd-sidebar-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .07);
            overflow: hidden;
            margin-bottom: 1.5rem
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
            gap: .5rem
        }

        .nd-sidebar-header span {
            color: #c9a84c
        }

        .nd-sidebar-links {
            padding: .5rem 0
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
            transition: background .15s
        }

        .nd-sidebar-link:last-child {
            border-bottom: none
        }

        .nd-sidebar-link:hover {
            background: #f0f4f8
        }

        .nd-sidebar-link.nd-ativo {
            background: #e8f0fe;
            border-left: 3px solid #1a3a5c
        }

        .nd-sidebar-link-icone {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .95rem;
            flex-shrink: 0
        }

        .nd-sumario {
            padding: .75rem 0
        }

        .nd-sumario-item {
            display: block;
            padding: .55rem 1.1rem;
            font-size: .85rem;
            color: #555;
            text-decoration: none;
            border-bottom: 1px solid #f5f5f5;
            transition: background .15s, color .15s
        }

        .nd-sumario-item:last-child {
            border-bottom: none
        }

        .nd-sumario-item:hover {
            background: #f8f9fa;
            color: #1a3a5c
        }

        .nd-sidebar-noticia {
            display: flex;
            gap: .75rem;
            padding: .85rem 1.1rem;
            border-bottom: 1px solid #f0f0f0;
            text-decoration: none;
            color: inherit;
            transition: background .15s
        }

        .nd-sidebar-noticia:last-child {
            border-bottom: none
        }

        .nd-sidebar-noticia:hover {
            background: #f8f9fa
        }

        .nd-sidebar-noticia-thumb {
            width: 72px;
            height: 54px;
            object-fit: cover;
            border-radius: 4px;
            flex-shrink: 0
        }

        .nd-sidebar-noticia-sem-foto {
            width: 72px;
            height: 54px;
            background: #e9ecef;
            border-radius: 4px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #bbb;
            font-size: 1.1rem
        }

        .nd-sidebar-noticia-titulo {
            font-size: .85rem;
            font-weight: 700;
            color: #1a1a2e;
            line-height: 1.35;
            margin: 0 0 .25rem
        }

        .nd-sidebar-noticia-data {
            font-size: .75rem;
            color: #aaa
        }

        .nd-destaque-box {
            background: linear-gradient(135deg, #1a3a5c, #2c5f8a);
            color: #fff;
            border-radius: 8px;
            padding: 1.5rem 2rem;
            margin: 2rem 0;
            font-size: 1.1rem;
            font-weight: 700;
            line-height: 1.6;
            text-align: center
        }

        .nd-destaque-box::before {
            content: '"';
            font-size: 3rem;
            line-height: 1;
            color: #c9a84c;
            display: block;
            margin-bottom: .25rem
        }
    </style>

    <section class="nd-wrapper">
        <div class="nd-container">

            <nav class="nd-nav-bar">
                <a href="/" class="nd-btn nd-btn-home">&#8962; Página Inicial</a>
                <a href="/noticias" class="nd-btn nd-btn-voltar">&#128240; Notícias</a>
                <span style="font-size:.85rem;color:#aaa">&#9670; Maçonaria</span>
            </nav>

            <div class="nd-row">

                {{-- ── Coluna principal ── --}}
                <div class="nd-col-principal">
                    <article class="nd-artigo">

                        <header class="nd-artigo-header">
                            <span class="nd-artigo-badge">&#9670; Maçonaria</span>
                            <h1 class="nd-artigo-titulo">O que é Maçonaria?</h1>
                        </header>

                        <div class="nd-artigo-conteudo">

                            <h3>&#9670; O que é a Maçonaria?</h3>
                            <p>
                                A maçonaria é uma sociedade fraternal que existe há séculos, com raízes que remontam
                                à Idade Média. Originalmente, os maçons eram pedreiros habilidosos que se reuniam em
                                guildas para compartilhar conhecimentos sobre a construção. Com o tempo, a maçonaria
                                evoluiu e passou a se basear em princípios filosóficos, morais e éticos, deixando de
                                lado as habilidades de construção física.
                            </p>

                            <h3>&#9670; O que é a Maçonaria hoje?</h3>
                            <p>
                                Atualmente, a maçonaria é uma organização que busca promover o desenvolvimento pessoal
                                de seus membros, incentivando virtudes como a justiça, fraternidade, honestidade e
                                caridade. Os maçons se reúnem em "lojas", que são grupos locais, onde participam de
                                rituais, palestras e discussões voltadas para o aprimoramento moral e intelectual.
                            </p>

                            <h3>&#9670; Princípios da Maçonaria</h3>
                            <p>Os maçons seguem princípios que giram em torno de três ideias centrais:</p>
                            <ol>
                                <li><strong>Liberdade:</strong> Valorização da liberdade de pensamento, de expressão e
                                    de crença, com respeito às diferenças individuais.</li>
                                <li><strong>Igualdade:</strong> Todos os membros são considerados iguais,
                                    independentemente de sua posição social ou econômica.</li>
                                <li><strong>Fraternidade:</strong> Ajudar uns aos outros e promover o bem-estar da
                                    sociedade como um todo, buscando sempre a paz e a harmonia.</li>
                            </ol>

                            <h3>&#9670; Simbolismo</h3>
                            <p>
                                A maçonaria usa muitos símbolos, herança de seu passado de construtores. Um exemplo
                                comum é o <strong>esquadro e compasso</strong>, que representam a retidão e a busca
                                pela perfeição moral. Esses símbolos são utilizados para ensinar lições sobre ética
                                e moralidade.
                            </p>

                            <h3>&#9670; Filantropia</h3>
                            <p>
                                Além do desenvolvimento pessoal, a maçonaria é conhecida por seu trabalho filantrópico.
                                Muitas lojas organizam projetos e eventos voltados à caridade, ajudando comunidades e
                                pessoas em situação de vulnerabilidade.
                            </p>

                            <h3>&#9670; Sigilo</h3>
                            <p>
                                A maçonaria é uma sociedade <strong>discreta</strong>, o que significa que seus rituais
                                e alguns ensinamentos são mantidos em segredo, mas suas atividades em geral não são
                                ocultas. Os membros são livres para dizer que são maçons, mas não compartilham detalhes
                                dos rituais ou das reuniões.
                            </p>

                            <h3>&#9670; Quem pode se tornar Maçom?</h3>
                            <p>
                                A maçonaria é aberta a homens que acreditam em um ser superior, independentemente de
                                sua religião. Em algumas partes do mundo, existem também ordens maçônicas femininas ou
                                mistas. Acredita-se que uma pessoa que busca se tornar maçom deve ter bom caráter e
                                estar disposta a seguir os princípios de moralidade e fraternidade que a ordem ensina.
                            </p>

                            <div class="nd-destaque-box">
                                Liberdade, Igualdade e Fraternidade — os três pilares que guiam cada irmão maçom
                                em sua jornada de aperfeiçoamento moral e espiritual.
                            </div>

                        </div>

                        <footer class="nd-artigo-rodape">
                            <span style="font-size:.85rem;color:#aaa">&#9670; ARLS Ferraz de Vasconcelos — N°
                                2516</span>
                            <a href="/" class="nd-btn nd-btn-home">&#8962; Voltar para o Início</a>
                        </footer>

                    </article>
                </div>

                {{-- ── Sidebar ── --}}
                <aside class="nd-col-sidebar">

                    <div class="nd-sidebar-card">
                        <div class="nd-sidebar-header"><span>&#9670;</span> Navegação</div>
                        <div class="nd-sidebar-links">
                            <a href="/" class="nd-sidebar-link">
                                <span class="nd-sidebar-link-icone"
                                    style="background:#e8f0fe;color:#1a3a5c">&#8962;</span>Página Inicial
                            </a>
                            <a href="/noticias" class="nd-sidebar-link">
                                <span class="nd-sidebar-link-icone"
                                    style="background:#e8f0fe;color:#1a3a5c">&#128240;</span>Notícias
                            </a>
                            <a href="/galeria" class="nd-sidebar-link">
                                <span class="nd-sidebar-link-icone"
                                    style="background:#e6f4ea;color:#2e7d32">&#128247;</span>Galeria de Fotos
                            </a>
                            <a href="/sobre-nos" class="nd-sidebar-link">
                                <span class="nd-sidebar-link-icone"
                                    style="background:#fff3e0;color:#e65100">&#9670;</span>Sobre Nós
                            </a>
                            <a href="/maconaria" class="nd-sidebar-link nd-ativo">
                                <span class="nd-sidebar-link-icone"
                                    style="background:#f3e5f5;color:#7b1fa2">&#9670;</span>O que é Maçonaria?
                            </a>
                            <a href="/maconaria-jovens" class="nd-sidebar-link">
                                <span class="nd-sidebar-link-icone"
                                    style="background:#f3e5f5;color:#7b1fa2">&#9670;</span>Maçonaria para Jovens
                            </a>
                            <a href="/mudar-cidadao" class="nd-sidebar-link">
                                <span class="nd-sidebar-link-icone"
                                    style="background:#f3e5f5;color:#7b1fa2">&#9670;</span>Maçonaria e o Cidadão
                            </a>
                        </div>
                    </div>

                    <div class="nd-sidebar-card">
                        <div class="nd-sidebar-header"><span>&#9670;</span> Nesta Página</div>
                        <div class="nd-sumario">
                            <span class="nd-sumario-item">&#9670; O que é a Maçonaria?</span>
                            <span class="nd-sumario-item">&#9670; A Maçonaria hoje</span>
                            <span class="nd-sumario-item">&#9670; Princípios</span>
                            <span class="nd-sumario-item">&#9670; Simbolismo</span>
                            <span class="nd-sumario-item">&#9670; Filantropia</span>
                            <span class="nd-sumario-item">&#9670; Sigilo</span>
                            <span class="nd-sumario-item">&#9670; Quem pode ser Maçom?</span>
                        </div>
                    </div>

                    @php
                        $noticiasMenu = \App\Models\Noticia::where('publicado', true)
                            ->latest('publicado_em')
                            ->take(5)
                            ->get();
                    @endphp
                    @if ($noticiasMenu->count() > 0)
                        <div class="nd-sidebar-card">
                            <div class="nd-sidebar-header"><span>&#9670;</span> Últimas Notícias</div>
                            @foreach ($noticiasMenu as $n)
                                <a href="/noticias/{{ $n->slug }}" class="nd-sidebar-noticia">
                                    @if ($n->foto_capa)
                                        <img src="{{ asset('storage/' . $n->foto_capa) }}"
                                            class="nd-sidebar-noticia-thumb" alt="{{ $n->titulo }}">
                                    @else
                                        <div class="nd-sidebar-noticia-sem-foto">&#9670;</div>
                                    @endif
                                    <div>
                                        <p class="nd-sidebar-noticia-titulo">
                                            {{ \Illuminate\Support\Str::limit($n->titulo, 65) }}</p>
                                        @if ($n->publicado_em)
                                            <span class="nd-sidebar-noticia-data">&#128197;
                                                {{ $n->publicado_em->format('d/m/Y') }}</span>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif

                </aside>

            </div>
        </div>
    </section>

    @include('landing.layouts.footer')
