{{--
    ============================================================
    View: landing/sobre-nos.blade.php
    Descrição: Página Sobre Nós — identidade visual da notícia-detalhe
    Layout: artigo principal (col larga) + sidebar de navegação
    Mesmo sistema de grid flex sem conflitar com style.css
    ============================================================
--}}
@include('landing.layouts.header')

<body>

    @include('landing.components.navbar')

    {{-- Banner da seção --}}
    <div class="bradcam_area breadcam_bg_sobre_nos">
        <h3>A . ' . R . ' . L . ' . S . ' .</h3>
        <h3>Ferraz de Vasconcelos</h3>
    </div>

    <style>
        /* ── Reutiliza exatamente os mesmos estilos do nd- ────── */
        .nd-wrapper {
            background: #f4f5f7;
            padding: 2.5rem 0 4rem;
        }

        .nd-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

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

        @media(max-width:900px) {
            .nd-row {
                flex-direction: column;
            }

            .nd-col-sidebar {
                width: 100%;
            }
        }

        /* Botões de navegação */
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
            transition: background .18s, color .18s;
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

        .nd-btn-voltar {
            background: transparent;
            color: #1a3a5c;
            border-color: #1a3a5c;
        }

        .nd-btn-voltar:hover {
            background: #1a3a5c;
            color: #fff;
        }

        /* Artigo */
        .nd-artigo {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .07);
        }

        .nd-artigo-header {
            padding: 2rem 2rem 1.5rem;
            border-bottom: 1px solid #f0f0f0;
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
            margin-bottom: .75rem;
        }

        .nd-artigo-titulo {
            font-size: 1.75rem;
            font-weight: 800;
            color: #1a1a2e;
            line-height: 1.3;
            margin: 0 0 1rem;
            border-left: 5px solid #c9a84c;
            padding-left: .85rem;
        }

        .nd-artigo-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.25rem;
            align-items: center;
            font-size: .83rem;
            color: #888;
        }

        /* Conteúdo */
        .nd-artigo-conteudo {
            padding: 1.75rem 2rem 2rem;
            font-size: 1.05rem;
            line-height: 1.85;
            color: #333;
        }

        .nd-artigo-conteudo p {
            margin-bottom: 1.25rem;
        }

        /* Subtítulos internos do artigo */
        .nd-artigo-conteudo h5 {
            font-size: 1rem;
            font-weight: 800;
            color: #1a3a5c;
            text-transform: uppercase;
            letter-spacing: .05em;
            border-left: 4px solid #c9a84c;
            padding-left: .65rem;
            margin: 2rem 0 .75rem;
        }

        .nd-artigo-conteudo h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a3a5c;
            margin: 1.75rem 0 1rem;
            line-height: 1.4;
        }

        /* Imagens dentro do artigo */
        .nd-foto-bloco {
            margin: 1.25rem 0 1.75rem;
            text-align: center;
        }

        .nd-foto-bloco img {
            max-width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, .12);
            display: inline-block;
        }

        .nd-foto-legenda {
            font-size: .8rem;
            color: #aaa;
            margin-top: .5rem;
            font-style: italic;
        }

        /* Destaque de frase / missão */
        .nd-missao {
            background: linear-gradient(135deg, #1a3a5c, #2c5f8a);
            color: #fff;
            border-radius: 8px;
            padding: 1.5rem 2rem;
            margin: 2rem 0;
            font-size: 1.15rem;
            font-weight: 700;
            line-height: 1.5;
            text-align: center;
            border-left: none;
        }

        .nd-missao::before {
            content: '"';
            font-size: 3rem;
            line-height: 1;
            color: #c9a84c;
            display: block;
            margin-bottom: .25rem;
        }

        /* Lista de fundadores */
        .nd-lista-fundadores {
            background: #faf7f0;
            border-left: 4px solid #c9a84c;
            border-radius: 0 8px 8px 0;
            padding: 1.25rem 1.5rem;
            margin: 1.25rem 0;
            font-size: .96rem;
            line-height: 1.8;
            color: #444;
        }

        /* Rodapé do artigo */
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

        /* Sidebar */
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
        }

        .nd-sidebar-link.nd-ativo {
            background: #e8f0fe;
            border-left: 3px solid #1a3a5c;
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

        /* Card de índice / sumário */
        .nd-sumario {
            padding: .75rem 0;
        }

        .nd-sumario-item {
            display: block;
            padding: .55rem 1.1rem;
            font-size: .85rem;
            color: #555;
            text-decoration: none;
            border-bottom: 1px solid #f5f5f5;
            transition: background .15s, color .15s;
        }

        .nd-sumario-item:last-child {
            border-bottom: none;
        }

        .nd-sumario-item:hover {
            background: #f8f9fa;
            color: #1a3a5c;
        }

        .nd-sumario-item::before {
            content: "&#9670; ";
            font-size: .65rem;
            color: #c9a84c;
        }

        /* Últimas notícias na sidebar */
        .nd-sidebar-noticia {
            display: flex;
            gap: .75rem;
            padding: .85rem 1.1rem;
            border-bottom: 1px solid #f0f0f0;
            text-decoration: none;
            color: inherit;
            transition: background .15s;
        }

        .nd-sidebar-noticia:last-child {
            border-bottom: none;
        }

        .nd-sidebar-noticia:hover {
            background: #f8f9fa;
        }

        .nd-sidebar-noticia-thumb {
            width: 72px;
            height: 54px;
            object-fit: cover;
            border-radius: 4px;
            flex-shrink: 0;
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
            font-size: 1.1rem;
        }

        .nd-sidebar-noticia-titulo {
            font-size: .85rem;
            font-weight: 700;
            color: #1a1a2e;
            line-height: 1.35;
            margin: 0 0 .25rem;
        }

        .nd-sidebar-noticia-data {
            font-size: .75rem;
            color: #aaa;
        }
    </style>

    <section class="nd-wrapper">
        <div class="nd-container">

            {{-- Barra de navegação --}}
            <nav class="nd-nav-bar">
                <a href="/" class="nd-btn nd-btn-home">&#8962; Página Inicial</a>
                <a href="/noticias" class="nd-btn nd-btn-voltar">&#128240; Notícias</a>
                <span style="font-size:.85rem;color:#aaa">&#9670; Sobre Nós</span>
            </nav>

            <div class="nd-row">

                {{-- ════════════════════════════════════════════
                 COLUNA PRINCIPAL — Conteúdo institucional
                 ════════════════════════════════════════════ --}}
                <div class="nd-col-principal">
                    <article class="nd-artigo">

                        {{-- Cabeçalho --}}
                        <header class="nd-artigo-header">
                            <span class="nd-artigo-badge">&#9670; Institucional</span>
                            <h1 class="nd-artigo-titulo">
                                Fundação da Augusta e Respeitável Loja Simbólica<br>
                                Ferraz de Vasconcelos N° 2516
                            </h1>
                            <div class="nd-artigo-meta">
                                <span>&#9670; Fundada em <strong>12 de outubro de 1988</strong></span>
                                <span>&#9670; Oriente de <strong>Ferraz de Vasconcelos — SP</strong></span>
                                <span>&#9670; Filiada ao <strong>GOSP</strong></span>
                            </div>
                        </header>

                        {{-- Logo da loja --}}
                        <div class="nd-foto-bloco" style="padding:1.5rem 2rem 0">
                            <img src="{{ asset('img/about/logo_loja.jpg') }}" alt="Logo da ARLS Ferraz de Vasconcelos"
                                style="max-width:280px">
                            <p class="nd-foto-legenda">Logo da ARLS Ferraz de Vasconcelos — N° 2516</p>
                        </div>

                        {{-- Conteúdo principal --}}
                        <div class="nd-artigo-conteudo">

                            {{-- Origem --}}
                            <p>
                                Para que os maçons da nossa região praticassem a verdadeira maçonaria em todos
                                os seus 33 graus faltavam fundações de mais Lojas Simbólicas para preencher os
                                requisitos exigidos pelos Estatutos Maçônicos.
                            </p>
                            <p>
                                Mais ou menos entre 1987 e 1988 nasceu um movimento na Loja União e Caridade
                                IV (23/08/1912) do Oriente de Mogi das Cruzes para fundar em nossa região um
                                Conselho dos Cavaleiros de Kadosch, uma Loja que abrangesse os Graus do 19 a 30.
                            </p>
                            <p>
                                Naquela época havia apenas quatro Lojas Simbólicas na nossa região: União e
                                Caridade IV (23/12/1912) e Cruzeiro do Itapeti (03/02/1969) — ambas do Oriente de
                                Mogi das Cruzes — além de 31 de Março II (31/03/1977) do Oriente de Suzano e
                                União e Perseverança (03/11/1983) do Oriente de Poá.
                            </p>
                            <p>
                                O movimento cresceu, tomou corpo e tornou-se uma realidade. Por ordem cronológica
                                foram fundadas as próximas Lojas Simbólicas — Renascimento (01/06/1988), Vale do
                                Tietê (20/08/1988), Nascente do Tietê (13/05/1988), <strong>Ferraz de Vasconcelos
                                    (12/10/1988)</strong>, 20 de Agosto (20/08/1989) e Acampamento dos Aprendizes
                                (09/10/1993).
                            </p>
                            <p>
                                Praticamente dobrou-se o número de Lojas da nossa região, e assim cumpriram-se os
                                requisitos para a instalação do Mui Poderoso Conselho dos Cavaleiros do Kadosch nº 65,
                                em Mogi das Cruzes, para os Graus 19 a 33. Mais tarde instalou-se também o
                                Consistório dos Príncipes do Real Segredo nº 51, completando o ciclo de evolução da
                                Maçonaria do Alto Tietê.
                            </p>

                            {{-- Fundação --}}
                            <h5>&#9670; A Fundação da Nossa Loja</h5>
                            <p>
                                A Fundação da ARLS Ferraz de Vasconcelos, no Rito Escocês Antigo e Aceito,
                                ocorreu no dia <strong>12/10/1988</strong> em Sessão realizada no Templo da Loja
                                União e Perseverança no Oriente de Poá, na Rua Monteiro Lobato nº 21.
                            </p>

                            <h5>&#9670; Termo de Abertura do Primeiro Livro de Atas e o Standart da Loja</h5>
                            <div class="nd-foto-bloco">
                                <img src="{{ asset('img/fundacao/fundacao_loja_arls.jpg') }}"
                                    alt="Fundação da ARLS Ferraz de Vasconcelos">
                                <p class="nd-foto-legenda">Documento histórico de fundação da Loja — 1988</p>
                            </div>

                            {{-- Irmãos fundadores --}}
                            <h5>&#9670; Irmãos Presentes na Sessão de Fundação</h5>
                            <div class="nd-lista-fundadores">
                                Oscar João Pachler, Emilio Sanches Dimitroff, Galdino Ferreira, Odair Lopes Pereira,
                                Carlos Roberto Riccio Genovezzi, Edson Marins, Noel Sampaio Rodrigues, João Manoel
                                Lobo, Carlos Alberto Bonfá, Marco Aurelio Alves Feitosa, Jose Antônio Lopes e os
                                <strong>irmãos fundadores</strong>: Walter Domingos Justolin, Antônio Latuf Cury,
                                João Batista Bio, Minoru Tamura, Francisco Ari Gomes Chaves, Arnaldo de Freitas Souza,
                                Giovani Vitorio Deliberato, Cypriano Osvaldo Monaco, Sergio Galicia, Roberto Elias
                                Xidieh, Milton Pereira e Francisco Xidieh.
                            </div>

                            <p>
                                A <strong>primeira Administração</strong> foi composta por: Venerável Mestre
                                Antônio Latuf Cury — 1º Vigilante Walter Domingos Justolin — 2º Vigilante João
                                Batista Bio — Orador Francisco Ari Gomes Chaves — Secretário Minoru Tamura —
                                Tesoureiro Arnaldo de Freitas Souza.
                            </p>
                            <p>
                                A autorização para o funcionamento da Loja foi através do Ato nº 004/89/91. A Carta
                                Constitutiva e demais documentos (Ato nº 029/89/91) foram recebidos em 01/07/1989
                                pela Comissão nomeada pelo Grão Mestre Estadual Irmão Décio Azevedo.
                            </p>

                            <h5>&#9670; Carta Constitutiva — In Memoriam Irmão Paulo Moraes</h5>
                            <div class="nd-foto-bloco">
                                <img src="{{ asset('img/fundacao/carta_constitutiva.png') }}"
                                    alt="Carta Constitutiva da ARLS Ferraz de Vasconcelos">
                                <p class="nd-foto-legenda">Carta Constitutiva original da Loja</p>
                            </div>

                            {{-- Missão --}}
                            <h5>&#9670; A Missão da Nossa Loja</h5>
                            <p>
                                Em 10 de setembro de 2001, foi encaminhada prancha ao Eminente Grão Mestre do
                                Grande Oriente de São Paulo comunicando que, após vários debates em Loja, os irmãos
                                aprovaram por unanimidade a <strong>Missão</strong> da Loja (Balaústre nº 252/2001
                                de 09/08/2001):
                            </p>
                            <div class="nd-missao">
                                Assistir aos necessitados, através da participação e Gestão de
                                Creches, Asilos, Orfanatos, Abrigos etc.
                            </div>

                            {{-- Creche --}}
                            <h5>&#9670; Centro de Educação Infantil Pequeno Aprendiz</h5>
                            <p>
                                Nossa meta inicial foi atender a Creche Comunitária da Mãe Pobre, hoje
                                <strong>Centro de Educação Infantil Pequeno Aprendiz</strong>, na Rua Sebastião de
                                Souza Lemos nº 200 — Jardim Pérola, Ferraz de Vasconcelos — SP. Na época atendia
                                50 crianças de 2 a 6 anos; hoje atende <strong>150 crianças</strong>.
                            </p>
                            <div class="nd-foto-bloco">
                                <img src="{{ asset('img/fundacao/pequeno_aprendiz.png') }}"
                                    alt="Centro de Educação Infantil Pequeno Aprendiz">
                                <p class="nd-foto-legenda">Centro de Educação Infantil Pequeno Aprendiz</p>
                            </div>

                            {{-- Templo --}}
                            <h5>&#9670; A Construção do Templo Próprio</h5>
                            <p>
                                A Loja crescia a cada dia e surgiu a necessidade de um Templo próprio. Após visitarem
                                várias lojas, os irmãos se inspiraram na Loja Renascimento do Oriente de Guararema e
                                sua tradicional "Festa do Porco Turbinado". Em 2008 aconteceu a <strong>1ª Festa do
                                    Boi no Rolete</strong>, chegando à sua 8ª edição em 2016.
                            </p>

                            <h5>&#9670; Matéria de Jornal — Boi no Rolete</h5>
                            <div class="nd-foto-bloco">
                                <img src="{{ asset('img/fundacao/jornal.png') }}"
                                    alt="Matéria de jornal sobre o Boi no Rolete">
                                <p class="nd-foto-legenda">Repercussão na imprensa local</p>
                            </div>

                            <h5>&#9670; Foto do Evento — Boi no Rolete</h5>
                            <div class="nd-foto-bloco">
                                <img src="{{ asset('img/fundacao/boi_rolete.png') }}" alt="Evento Boi no Rolete">
                                <p class="nd-foto-legenda">Evento que financiou a construção do Templo</p>
                            </div>

                            {{-- Sagração --}}
                            <h5>&#9670; Sagração do Templo Antônio Latuf Cury</h5>
                            <p>
                                O novo Templo, chamado <strong>"Antônio Latuf Cury"</strong>, foi sagrado em
                                <strong>18 de maio de 2017</strong>, com capacidade para até 120 irmãos, localizado
                                na Rua Jornalista Sebastião de Souza Lemos nº 200-B — Jardim Pérola, Ferraz de
                                Vasconcelos. A Sessão Magna foi presidida pelo Irmão Francisco dos Santos Perez,
                                sob a proteção do <strong>Grande Arquiteto do Universo</strong>.
                            </p>
                            <div class="nd-foto-bloco">
                                <img src="{{ asset('img/fundacao/sagracao.png') }}" alt="Sagração do Templo">
                                <p class="nd-foto-legenda">Cerimônia de Sagração do Templo Antônio Latuf Cury — 2017</p>
                            </div>

                            {{-- GOSP --}}
                            <h5>&#9670; A Desfederalização e o GOSP</h5>
                            <p>
                                Com a desfederalização do Grande Oriente de São Paulo do Grande Oriente do Brasil
                                em 2018, e após deliberação em Loja, o <strong>GOSP</strong> tornou-se nossa Potência
                                Maçônica. A Carta Constitutiva foi novamente expedida pelo Sereníssimo Grão-Mestre
                                do GOSP, Irmão Kamel Aref Saab. Continuam em nosso quadro de obreiros os irmãos
                                fundadores <strong>Walter Domingues Justolin</strong> e <strong>Antônio Latuf
                                    Cury</strong>.
                            </p>

                            <h5>&#9670; Primeira Reunião no Novo Templo</h5>
                            <div class="nd-foto-bloco">
                                <img src="{{ asset('img/fundacao/primeira_reuniao.png') }}"
                                    alt="Primeira reunião no Templo">
                                <p class="nd-foto-legenda">Primeiro encontro oficial no Templo Antônio Latuf Cury</p>
                            </div>

                            <h5>&#9670; Evento Comemorativo</h5>
                            <div class="nd-foto-bloco">
                                <img src="{{ asset('img/fundacao/evento_comemorativo.png') }}"
                                    alt="Evento Comemorativo">
                                <p class="nd-foto-legenda">Comemorações da nossa história</p>
                            </div>

                            {{-- Encerramento --}}
                            <h5>&#9670; Essa Foi a Nossa História!</h5>
                            <div class="nd-foto-bloco">
                                <img src="{{ asset('img/fundacao/loja.png') }}" alt="Nossa Loja">
                                <p class="nd-foto-legenda">ARLS Ferraz de Vasconcelos — N° 2516</p>
                            </div>
                            <div class="nd-foto-bloco">
                                <img src="{{ asset('img/about/logo_loja.jpg') }}" alt="Logo da Loja"
                                    style="max-width:200px">
                            </div>

                        </div>{{-- fim nd-artigo-conteudo --}}

                        {{-- Rodapé do artigo --}}
                        <footer class="nd-artigo-rodape">
                            <span style="font-size:.85rem;color:#aaa">
                                &#9670; ARLS Ferraz de Vasconcelos — Fundada em 12/10/1988
                            </span>
                            <a href="/" class="nd-btn nd-btn-home">&#8962; Voltar para o Início</a>
                        </footer>

                    </article>
                </div>{{-- fim nd-col-principal --}}

                {{-- ════════════════════════════════════════════
                 SIDEBAR — Navegação e últimas notícias
                 ════════════════════════════════════════════ --}}
                <aside class="nd-col-sidebar">

                    {{-- Card: Navegação do site --}}
                    <div class="nd-sidebar-card">
                        <div class="nd-sidebar-header">
                            <span>&#9670;</span> Navegação
                        </div>
                        <div class="nd-sidebar-links">
                            <a href="/" class="nd-sidebar-link">
                                <span class="nd-sidebar-link-icone"
                                    style="background:#e8f0fe;color:#1a3a5c">&#8962;</span>
                                Página Inicial
                            </a>
                            <a href="/noticias" class="nd-sidebar-link">
                                <span class="nd-sidebar-link-icone"
                                    style="background:#e8f0fe;color:#1a3a5c">&#128240;</span>
                                Notícias
                            </a>
                            <a href="/galeria" class="nd-sidebar-link">
                                <span class="nd-sidebar-link-icone"
                                    style="background:#e6f4ea;color:#2e7d32">&#128247;</span>
                                Galeria de Fotos
                            </a>
                            <a href="/sobre-nos" class="nd-sidebar-link nd-ativo">
                                <span class="nd-sidebar-link-icone"
                                    style="background:#fff3e0;color:#e65100">&#9670;</span>
                                Sobre Nós
                            </a>
                            <a href="/maconaria" class="nd-sidebar-link">
                                <span class="nd-sidebar-link-icone"
                                    style="background:#f3e5f5;color:#7b1fa2">&#9670;</span>
                                O que é Maçonaria?
                            </a>
                            <a href="/maconaria-jovens" class="nd-sidebar-link">
                                <span class="nd-sidebar-link-icone"
                                    style="background:#f3e5f5;color:#7b1fa2">&#9670;</span>
                                Maçonaria para Jovens
                            </a>
                            <a href="/mudar-cidadao" class="nd-sidebar-link">
                                <span class="nd-sidebar-link-icone"
                                    style="background:#f3e5f5;color:#7b1fa2">&#9670;</span>
                                Maçonaria e o Cidadão
                            </a>
                            <a href="/jantar" class="nd-sidebar-link">
                                <span class="nd-sidebar-link-icone"
                                    style="background:#fce4ec;color:#c62828">&#127869;</span>
                                Jantar Ritualístico
                            </a>
                        </div>
                    </div>

                    {{-- Card: Sumário da página --}}
                    <div class="nd-sidebar-card">
                        <div class="nd-sidebar-header">
                            <span>&#9670;</span> Nesta Página
                        </div>
                        <div class="nd-sumario">
                            <span class="nd-sumario-item">&#9670; A Fundação da Loja</span>
                            <span class="nd-sumario-item">&#9670; Irmãos Fundadores</span>
                            <span class="nd-sumario-item">&#9670; Carta Constitutiva</span>
                            <span class="nd-sumario-item">&#9670; A Missão da Loja</span>
                            <span class="nd-sumario-item">&#9670; Centro Pequeno Aprendiz</span>
                            <span class="nd-sumario-item">&#9670; Festa do Boi no Rolete</span>
                            <span class="nd-sumario-item">&#9670; Templo Antônio Latuf Cury</span>
                            <span class="nd-sumario-item">&#9670; Desfederalização e GOSP</span>
                        </div>
                    </div>

                    {{-- Card: Últimas notícias --}}
                    @php
                        $ultimasNoticiassidebar = \App\Models\Noticia::where('publicado', true)
                            ->latest('publicado_em')
                            ->take(5)
                            ->get();
                    @endphp

                    @if ($ultimasNoticiassidebar->count() > 0)
                        <div class="nd-sidebar-card">
                            <div class="nd-sidebar-header">
                                <span>&#9670;</span> Últimas Notícias
                            </div>
                            @foreach ($ultimasNoticiassidebar as $n)
                                <a href="/noticias/{{ $n->slug }}" class="nd-sidebar-noticia">
                                    @if ($n->foto_capa)
                                        <img src="{{ asset('storage/' . $n->foto_capa) }}"
                                            class="nd-sidebar-noticia-thumb" alt="{{ $n->titulo }}">
                                    @else
                                        <div class="nd-sidebar-noticia-sem-foto">&#9670;</div>
                                    @endif
                                    <div>
                                        <p class="nd-sidebar-noticia-titulo">
                                            {{ \Illuminate\Support\Str::limit($n->titulo, 65) }}
                                        </p>
                                        @if ($n->publicado_em)
                                            <span class="nd-sidebar-noticia-data">
                                                &#128197; {{ $n->publicado_em->format('d/m/Y') }}
                                            </span>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif

                    {{-- Card: Contato --}}
                    <div class="nd-sidebar-card">
                        <div class="nd-sidebar-header">
                            <span>&#9670;</span> Nossa Loja
                        </div>
                        <div style="padding:1.1rem">
                            <p style="font-size:.88rem;color:#555;line-height:1.6;margin:0 0 .75rem">
                                <strong style="color:#1a3a5c">&#127968; Endereço</strong><br>
                                Rua Sebastião Souza Lemos, 240<br>
                                Jardim Pérola — Ferraz de Vasconcelos/SP<br>
                                CEP 08544-440
                            </p>
                            <p style="font-size:.88rem;color:#555;line-height:1.6;margin:0 0 .75rem">
                                <strong style="color:#1a3a5c">&#128197; Reuniões</strong><br>
                                1ª, 2ª e 3ª quinta-feira de cada mês
                            </p>
                            <p style="font-size:.88rem;color:#555;line-height:1.6;margin:0">
                                <strong style="color:#1a3a5c">&#9670; Filiada ao GOSP</strong><br>
                                Grande Oriente de São Paulo<br>
                                Loja N° 2516
                            </p>
                        </div>
                    </div>

                </aside>{{-- fim nd-col-sidebar --}}

            </div>{{-- fim nd-row --}}
        </div>{{-- fim nd-container --}}
    </section>

    @include('landing.layouts.footer')
