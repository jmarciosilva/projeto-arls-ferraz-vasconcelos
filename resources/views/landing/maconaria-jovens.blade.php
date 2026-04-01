{{--
    ============================================================
    View: landing/maconaria-jovens.blade.php
    Descrição: Ordem DeMolay e Filhas de Jó — layout padrão institucional
    ============================================================
--}}
@include('landing.layouts.header')

<body>
    @include('landing.components.navbar')

    <div class="bradcam_area breadcam_bg_demolay"></div>

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

        .nd-secao-divisor {
            margin: 2.5rem -2rem;
            padding: 1.5rem 2rem;
            background: linear-gradient(135deg, #1a3a5c, #2c5f8a);
            color: #fff;
            font-size: 1.3rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: .75rem
        }

        .nd-secao-divisor span {
            color: #c9a84c;
            font-size: 1.8rem
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
    </style>

    <section class="nd-wrapper">
        <div class="nd-container">

            <nav class="nd-nav-bar">
                <a href="/" class="nd-btn nd-btn-home">&#8962; Página Inicial</a>
                <a href="/noticias" class="nd-btn nd-btn-voltar">&#128240; Notícias</a>
                <span style="font-size:.85rem;color:#aaa">&#9670; Maçonaria para Jovens</span>
            </nav>

            <div class="nd-row">

                <div class="nd-col-principal">
                    <article class="nd-artigo">

                        <header class="nd-artigo-header">
                            <span class="nd-artigo-badge">&#9670; Maçonaria</span>
                            <h1 class="nd-artigo-titulo">Ordem DeMolay e Filhas de Jó</h1>
                        </header>

                        <div class="nd-artigo-conteudo">

                            <p>
                                Tanto a <strong>Ordem DeMolay</strong> quanto as <strong>Filhas de Jó</strong> são
                                organizações para jovens, criadas com o apoio da maçonaria e baseadas em princípios
                                de moralidade, ética e desenvolvimento pessoal. Embora estejam associadas à maçonaria,
                                essas ordens são independentes e abertas a jovens que desejam aprender sobre liderança,
                                valores morais e servir à comunidade.
                            </p>

                            {{-- SEÇÃO DEMOLAY --}}
                            <div class="nd-secao-divisor">
                                <span>&#9670;</span> Ordem DeMolay
                            </div>

                            <h3>&#9670; O que é a Ordem DeMolay?</h3>
                            <p>
                                A <strong>Ordem DeMolay</strong> é uma organização fraternal voltada para jovens do
                                sexo masculino, geralmente entre 12 e 21 anos. Foi fundada em 1919, nos Estados Unidos,
                                por Frank S. Land, com o objetivo de formar líderes e promover valores como o respeito,
                                o amor à pátria, a honestidade e a fraternidade.
                            </p>

                            <h3>&#9670; As Sete Virtudes Cardeais da Ordem DeMolay</h3>
                            <ol>
                                <li><strong>Amor filial:</strong> Respeito e carinho pelos pais e familiares.</li>
                                <li><strong>Reverência pelas coisas sagradas:</strong> Respeito à espiritualidade e à
                                    religião.</li>
                                <li><strong>Cortesia:</strong> Tratamento respeitoso e educado a todas as pessoas.</li>
                                <li><strong>Companheirismo:</strong> Valorização das amizades verdadeiras e do apoio
                                    mútuo.</li>
                                <li><strong>Fidelidade:</strong> Lealdade aos princípios, aos amigos e à palavra dada.
                                </li>
                                <li><strong>Pureza:</strong> Busca de uma vida moralmente íntegra e ética.</li>
                                <li><strong>Patriotismo:</strong> Amor e respeito pela pátria.</li>
                            </ol>

                            <h3>&#9670; Atividades e Rituais</h3>
                            <p>
                                Os membros da <strong>Ordem DeMolay</strong> participam de reuniões e rituais, que são
                                simbólicos e transmitem lições de moral e ética. Além disso, realizam projetos
                                comunitários e filantrópicos, desenvolvendo habilidades de liderança e responsabilidade
                                social.
                            </p>
                            <p>
                                Embora tenha origem nos valores maçônicos, a <strong>Ordem DeMolay</strong> é aberta
                                a jovens que não têm familiares maçons. Muitos maçons adultos começaram suas jornadas
                                como DeMolays.
                            </p>

                            {{-- SEÇÃO FILHAS DE JO --}}
                            <div class="nd-secao-divisor">
                                <span>&#9670;</span> Filhas de Jó Internacional
                            </div>

                            <h3>&#9670; O que são as Filhas de Jó?</h3>
                            <p>
                                As <strong>Filhas de Jó</strong> são uma organização juvenil voltada para meninas e
                                jovens mulheres, geralmente entre 10 e 20 anos. Foi fundada em 1920 por Ethel T.
                                Wead Mick, nos Estados Unidos, inspirada na figura bíblica de Jó — mais especificamente
                                na integridade e virtudes de suas filhas.
                            </p>

                            <h3>&#9670; Princípios das Filhas de Jó</h3>
                            <ol>
                                <li><strong>Honestidade:</strong> Viver com sinceridade e integridade.</li>
                                <li><strong>Fidelidade:</strong> Ser leal aos compromissos e às amizades.</li>
                                <li><strong>Respeito:</strong> Tratar os outros com dignidade e reverência às tradições.
                                </li>
                                <li><strong>Caridade:</strong> Prática da bondade e do serviço comunitário.</li>
                            </ol>

                            <h3>&#9670; Atividades e Rituais</h3>
                            <p>
                                As reuniões e cerimônias das <strong>Filhas de Jó</strong> têm caráter moral e
                                educacional. As jovens participam de projetos beneficentes e eventos sociais que
                                promovem a união, o crescimento pessoal e o fortalecimento de suas comunidades.
                            </p>

                            <h3>&#9670; Conexão com a Maçonaria</h3>
                            <p>
                                Embora as duas organizações tenham uma ligação histórica e filosófica com a maçonaria,
                                não é necessário que os pais sejam maçons para participar. A maçonaria apoia essas
                                ordens porque compartilham os mesmos valores de desenvolvimento moral, educação e
                                fraternidade — mas as ordens funcionam de maneira independente.
                            </p>
                            <p>
                                Tanto a <strong>Ordem DeMolay</strong> quanto as <strong>Filhas de Jó</strong> são
                                excelentes caminhos para jovens que buscam aprender sobre ética, responsabilidade e
                                serviço à comunidade, preparando seus membros para serem líderes em suas vidas.
                            </p>

                        </div>

                        <footer class="nd-artigo-rodape">
                            <span style="font-size:.85rem;color:#aaa">&#9670; ARLS Ferraz de Vasconcelos — N°
                                2516</span>
                            <a href="/" class="nd-btn nd-btn-home">&#8962; Voltar para o Início</a>
                        </footer>

                    </article>
                </div>

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
                            <a href="/sobre-nos" class="nd-sidebar-link">
                                <span class="nd-sidebar-link-icone"
                                    style="background:#fff3e0;color:#e65100">&#9670;</span>Sobre Nós
                            </a>
                            <a href="/maconaria" class="nd-sidebar-link">
                                <span class="nd-sidebar-link-icone"
                                    style="background:#f3e5f5;color:#7b1fa2">&#9670;</span>O que é Maçonaria?
                            </a>
                            <a href="/maconaria-jovens" class="nd-sidebar-link nd-ativo">
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
                            <span class="nd-sumario-item">&#9670; Sobre as Organizações</span>
                            <span class="nd-sumario-item">&#9670; Ordem DeMolay</span>
                            <span class="nd-sumario-item">&#9670; As 7 Virtudes DeMolay</span>
                            <span class="nd-sumario-item">&#9670; Filhas de Jó</span>
                            <span class="nd-sumario-item">&#9670; Princípios das Filhas de Jó</span>
                            <span class="nd-sumario-item">&#9670; Conexão com a Maçonaria</span>
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
