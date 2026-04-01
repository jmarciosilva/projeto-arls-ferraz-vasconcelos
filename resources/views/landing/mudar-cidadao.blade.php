{{--
    ============================================================
    View: landing/mudar-cidadao.blade.php
    Descrição: Como a Maçonaria pode mudar um cidadão — layout padrão
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
            font-size: 1.65rem;
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
            font-size: 1.1rem;
            font-weight: 800;
            color: #1a3a5c;
            border-left: 4px solid #c9a84c;
            padding-left: .65rem;
            margin: 2rem 0 .75rem;
            text-transform: uppercase;
            letter-spacing: .04em
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

        .nd-conclusao {
            background: linear-gradient(135deg, #1a3a5c, #2c5f8a);
            color: #fff;
            border-radius: 8px;
            padding: 1.5rem 2rem;
            margin: 2rem 0;
            font-size: 1.05rem;
            line-height: 1.7
        }

        .nd-conclusao strong {
            color: #c9a84c
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
                <span style="font-size:.85rem;color:#aaa">&#9670; Maçonaria e o Cidadão</span>
            </nav>

            <div class="nd-row">

                <div class="nd-col-principal">
                    <article class="nd-artigo">

                        <header class="nd-artigo-header">
                            <span class="nd-artigo-badge">&#9670; Maçonaria</span>
                            <h1 class="nd-artigo-titulo">Como a Maçonaria pode mudar um cidadão nos dias atuais?</h1>
                        </header>

                        <div class="nd-artigo-conteudo">

                            <p>
                                A <strong>Maçonaria</strong> é uma instituição que busca o aprimoramento moral,
                                espiritual e social de seus membros, oferecendo um ambiente de reflexão, aprendizado
                                e desenvolvimento. Nos dias de hoje, ela pode promover mudanças significativas em um
                                cidadão, influenciando positivamente vários aspectos da vida pessoal, profissional
                                e comunitária.
                            </p>

                            <h3>&#9670; 1. Desenvolvimento Moral e Ético</h3>
                            <p>
                                A Maçonaria incentiva seus membros a se tornarem pessoas melhores através da prática
                                de princípios morais como a <strong>honestidade, integridade, justiça e
                                    verdade</strong>.
                                Ao participar dos rituais e debates filosóficos, o maçom é constantemente lembrado de
                                suas responsabilidades éticas consigo mesmo, com sua família e com a sociedade.
                            </p>

                            <h3>&#9670; 2. Fortalecimento do Caráter</h3>
                            <p>
                                A Maçonaria prega o autoconhecimento e o autoaprimoramento. Seus ensinamentos promovem
                                a ideia de que cada pessoa deve trabalhar continuamente para se tornar uma versão melhor
                                de si mesma, cultivando virtudes como a <strong>tolerância, a paciência e a
                                    humildade</strong>.
                            </p>

                            <h3>&#9670; 3. Fomento ao Altruísmo e à Caridade</h3>
                            <p>
                                Um dos pilares da Maçonaria é o serviço à comunidade. A instituição está profundamente
                                envolvida em obras filantrópicas, incentivando seus membros a realizarem ações que
                                beneficiem o próximo, seja por meio de trabalho voluntário, doações ou projetos que
                                visam o bem comum.
                            </p>

                            <h3>&#9670; 4. Estímulo ao Pensamento Crítico e Reflexivo</h3>
                            <p>
                                A Maçonaria promove o debate, a busca pelo conhecimento e o questionamento de dogmas
                                e preconceitos, incentivando seus membros a serem pensadores independentes. Isso ajuda
                                o cidadão a tomar decisões mais conscientes e a adotar uma postura equilibrada diante
                                de desafios.
                            </p>

                            <h3>&#9670; 5. Valorização das Relações Fraternais</h3>
                            <p>
                                O conceito de <strong>fraternidade</strong> é central na filosofia maçônica. Membros
                                são incentivados a criar laços fortes entre si, baseados em confiança e respeito mútuo.
                                Esse espírito fraterno pode ser transferido para as relações familiares, de amizade e
                                de trabalho.
                            </p>

                            <h3>&#9670; 6. Compromisso com a Justiça e a Igualdade</h3>
                            <p>
                                A Maçonaria acredita na construção de uma sociedade mais justa e igualitária. Ela
                                incentiva o maçom a lutar contra a injustiça, o preconceito e a intolerância em todas
                                as suas formas, tornando-o um agente ativo de mudança social.
                            </p>

                            <h3>&#9670; 7. Aprimoramento da Liderança e Responsabilidade</h3>
                            <p>
                                Ao participar de uma Loja Maçônica, o maçom tem a oportunidade de ocupar cargos de
                                liderança, promovendo o desenvolvimento de habilidades de <strong>gestão, tomada de
                                    decisão e responsabilidade</strong> que podem ser aplicadas na vida profissional.
                            </p>

                            <h3>&#9670; 8. Respeito à Diversidade de Crenças e Opiniões</h3>
                            <p>
                                A Maçonaria acolhe homens de todas as religiões, desde que acreditem em um Ser
                                Supremo. Essa abertura promove uma mentalidade <strong>tolerante e aberta</strong>,
                                algo extremamente importante em um mundo frequentemente marcado pela polarização.
                            </p>

                            <h3>&#9670; 9. Estímulo à Vida Espiritual</h3>
                            <p>
                                Embora não seja uma religião, a Maçonaria incentiva seus membros a refletirem sobre
                                questões espirituais e a buscarem uma vida de elevação espiritual, independente da
                                crença religiosa.
                            </p>

                            <h3>&#9670; 10. Construção de um Legado Duradouro</h3>
                            <p>
                                Por meio de seus ensinamentos, a Maçonaria incentiva seus membros a pensarem no
                                legado que deixarão para as gerações futuras, inspirando ações que visem o bem-estar
                                coletivo e a sustentabilidade.
                            </p>

                            {{-- Conclusão --}}
                            <div class="nd-conclusao">
                                <strong>Conclusão:</strong> Nos dias de hoje, a Maçonaria oferece aos seus membros
                                uma base sólida de valores éticos, morais e sociais, que podem transformar o cidadão
                                em um agente de mudança, um líder compassivo e uma pessoa de caráter íntegro. Seus
                                ensinamentos, aplicados à vida cotidiana, têm o potencial de gerar cidadãos mais
                                conscientes, responsáveis e comprometidos com o progresso e a harmonia social.
                            </div>

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
                            <a href="/maconaria-jovens" class="nd-sidebar-link">
                                <span class="nd-sidebar-link-icone"
                                    style="background:#f3e5f5;color:#7b1fa2">&#9670;</span>Maçonaria para Jovens
                            </a>
                            <a href="/mudar-cidadao" class="nd-sidebar-link nd-ativo">
                                <span class="nd-sidebar-link-icone"
                                    style="background:#f3e5f5;color:#7b1fa2">&#9670;</span>Maçonaria e o Cidadão
                            </a>
                        </div>
                    </div>

                    <div class="nd-sidebar-card">
                        <div class="nd-sidebar-header"><span>&#9670;</span> Nesta Página</div>
                        <div class="nd-sumario">
                            <span class="nd-sumario-item">&#9670; 1. Desenvolvimento Moral</span>
                            <span class="nd-sumario-item">&#9670; 2. Fortalecimento do Caráter</span>
                            <span class="nd-sumario-item">&#9670; 3. Altruísmo e Caridade</span>
                            <span class="nd-sumario-item">&#9670; 4. Pensamento Crítico</span>
                            <span class="nd-sumario-item">&#9670; 5. Relações Fraternais</span>
                            <span class="nd-sumario-item">&#9670; 6. Justiça e Igualdade</span>
                            <span class="nd-sumario-item">&#9670; 7. Liderança</span>
                            <span class="nd-sumario-item">&#9670; 8. Diversidade de Crenças</span>
                            <span class="nd-sumario-item">&#9670; 9. Vida Espiritual</span>
                            <span class="nd-sumario-item">&#9670; 10. Legado Duradouro</span>
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
