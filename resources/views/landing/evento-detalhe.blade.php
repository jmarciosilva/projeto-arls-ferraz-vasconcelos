{{--
    ============================================================
    View: landing/evento-detalhe.blade.php
    Descrição: Página pública de detalhe de um evento
    Layout: mesmo padrão da notícia-detalhe (artigo + sidebar)
    ============================================================
--}}
@include('landing.layouts.header')

<body>

@include('landing.components.navbar')

{{-- Banner --}}
<div class="bradcam_area breadcam_bg_sobre_nos">
    <h3>Eventos</h3>
</div>

<style>
    /* Reutiliza o mesmo sistema nd- da notícia-detalhe */
    .nd-wrapper { background:#f4f5f7; padding:2.5rem 0 4rem; }
    .nd-container { max-width:1200px; margin:0 auto; padding:0 20px; }
    .nd-row { display:flex; flex-wrap:wrap; gap:28px; align-items:flex-start; }
    .nd-col-principal { flex:1 1 0; min-width:0; }
    .nd-col-sidebar { width:320px; flex-shrink:0; }
    @media(max-width:900px){
        .nd-row { flex-direction:column; }
        .nd-col-sidebar { width:100%; }
    }
    .nd-nav-bar { display:flex; align-items:center; gap:.75rem; margin-bottom:1.5rem; flex-wrap:wrap; }
    .nd-btn { display:inline-flex; align-items:center; gap:.4rem; padding:.45rem 1rem;
              border-radius:5px; font-size:.88rem; font-weight:600; text-decoration:none;
              border:2px solid transparent; transition:background .18s, color .18s; }
    .nd-btn-home { background:#1a3a5c; color:#fff; border-color:#1a3a5c; }
    .nd-btn-home:hover { background:#0f2540; color:#fff; }
    .nd-btn-voltar { background:transparent; color:#1a3a5c; border-color:#1a3a5c; }
    .nd-btn-voltar:hover { background:#1a3a5c; color:#fff; }

    /* Artigo */
    .nd-artigo { background:#fff; border-radius:8px; overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,.07); }
    .nd-artigo-header { padding:2rem 2rem 1.5rem; border-bottom:1px solid #f0f0f0; }
    .nd-artigo-conteudo { padding:1.75rem 2rem 2rem; font-size:1.05rem; line-height:1.85; color:#333; }
    .nd-artigo-conteudo p { margin-bottom:1.25rem; }
    .nd-artigo-conteudo h2,
    .nd-artigo-conteudo h3 { color:#1a3a5c; margin:1.5rem 0 .75rem; }
    .nd-artigo-conteudo img { max-width:100%; border-radius:6px; margin:1rem 0; }
    .nd-artigo-rodape { padding:1.25rem 2rem; border-top:1px solid #f0f0f0; display:flex;
                        justify-content:space-between; align-items:center;
                        flex-wrap:wrap; gap:1rem; background:#fafafa; }

    /* Box de informações do evento */
    .ev-info-box {
        background:linear-gradient(135deg, #1a3a5c, #2c5f8a);
        border-radius:8px; padding:1.5rem 2rem; margin:0 2rem 1.5rem;
        display:grid; grid-template-columns:1fr 1fr; gap:1rem;
    }
    @media(max-width:600px){ .ev-info-box { grid-template-columns:1fr; } }
    .ev-info-item { display:flex; align-items:flex-start; gap:.6rem; }
    .ev-info-item i { color:#c9a84c; font-size:1.1rem; margin-top:2px; flex-shrink:0; }
    .ev-info-label { font-size:.75rem; text-transform:uppercase; letter-spacing:.07em;
                     color:rgba(255,255,255,.6); display:block; margin-bottom:.15rem; }
    .ev-info-valor { color:#fff; font-size:.95rem; font-weight:600; }

    /* Box de ingresso/inscrição */
    .ev-inscricao-box {
        margin:0 2rem 1.5rem;
        background:#fff8e1; border-left:4px solid #c9a84c;
        border-radius:0 8px 8px 0; padding:1.25rem 1.5rem;
    }
    .ev-inscricao-box h4 { color:#1a3a5c; font-size:1.05rem; font-weight:800; margin:0 0 .5rem; }
    .ev-inscricao-btn {
        display:inline-flex; align-items:center; gap:.5rem;
        background:#1a3a5c; color:#fff; padding:.6rem 1.4rem;
        border-radius:6px; font-weight:700; text-decoration:none;
        font-size:.95rem; margin-top:.75rem; transition:background .18s;
    }
    .ev-inscricao-btn:hover { background:#0f2540; color:#fff; }

    /* Botões de mapa */
    .ev-map-row { display:flex; gap:.75rem; flex-wrap:wrap; padding:.9rem 2rem;
                  background:#fafafa; border-top:1px solid #f0f0f0; }
    .ev-map-btn { display:inline-flex; align-items:center; gap:.4rem; padding:.45rem 1rem;
                  border-radius:5px; font-size:.88rem; font-weight:600;
                  text-decoration:none; transition:opacity .18s; }
    .ev-map-btn:hover { opacity:.85; }

    /* Compartilhar */
    .nd-compartilhar { display:flex; align-items:center; gap:.6rem; font-size:.85rem; color:#888; }
    .nd-share-btn { display:inline-flex; align-items:center; justify-content:center;
                    width:34px; height:34px; border-radius:50%;
                    text-decoration:none; font-size:1rem; transition:opacity .18s; }
    .nd-share-btn:hover { opacity:.8; }
    .nd-share-fb { background:#1877f2; color:#fff; }
    .nd-share-wa { background:#25d366; color:#fff; }

    /* Sidebar */
    .nd-sidebar-card { background:#fff; border-radius:8px; box-shadow:0 2px 12px rgba(0,0,0,.07);
                       overflow:hidden; margin-bottom:1.5rem; }
    .nd-sidebar-header { padding:.85rem 1.1rem; background:#1a3a5c; color:#fff;
                         font-size:.88rem; font-weight:800; text-transform:uppercase;
                         letter-spacing:.07em; display:flex; align-items:center; gap:.5rem; }
    .nd-sidebar-header span { color:#c9a84c; }
    .nd-sidebar-links { padding:.5rem 0; }
    .nd-sidebar-link { display:flex; align-items:center; gap:.6rem; padding:.7rem 1.1rem;
                       text-decoration:none; color:#1a3a5c; font-size:.9rem; font-weight:600;
                       border-bottom:1px solid #f0f0f0; transition:background .15s; }
    .nd-sidebar-link:last-child { border-bottom:none; }
    .nd-sidebar-link:hover { background:#f0f4f8; }
    .nd-sidebar-link-icone { width:30px; height:30px; border-radius:50%; display:flex;
                              align-items:center; justify-content:center;
                              font-size:.95rem; flex-shrink:0; }
    .nd-sidebar-evento { display:flex; gap:.75rem; padding:.85rem 1.1rem;
                         border-bottom:1px solid #f0f0f0; text-decoration:none;
                         color:inherit; transition:background .15s; }
    .nd-sidebar-evento:last-child { border-bottom:none; }
    .nd-sidebar-evento:hover { background:#f8f9fa; }
    .nd-sidebar-evento-thumb { width:72px; height:54px; object-fit:cover;
                                border-radius:4px; flex-shrink:0; }
    .nd-sidebar-evento-sem-foto { width:72px; height:54px; border-radius:4px;
                                   flex-shrink:0; display:flex; align-items:center;
                                   justify-content:center; font-size:1.3rem; }
    .nd-sidebar-evento-titulo { font-size:.85rem; font-weight:700; color:#1a1a2e;
                                  line-height:1.35; margin:0 0 .25rem; }
    .nd-sidebar-evento-data { font-size:.75rem; color:#aaa; }
</style>

<section class="nd-wrapper">
    <div class="nd-container">

        {{-- Navegação --}}
        <nav class="nd-nav-bar">
            <a href="/" class="nd-btn nd-btn-home">&#8962; Página Inicial</a>
            <a href="/noticias" class="nd-btn nd-btn-voltar">&#128240; Notícias</a>
            <span style="font-size:.85rem;color:#aaa">&#9670; Eventos</span>
        </nav>

        <div class="nd-row">

            {{-- ════════════════════════════
                 COLUNA PRINCIPAL
                 ════════════════════════════ --}}
            <div class="nd-col-principal">
                <article class="nd-artigo">

                    {{-- Cabeçalho --}}
                    <header class="nd-artigo-header">
                        {{-- Badge do tipo --}}
                        <span style="display:inline-block;background:{{ $evento->tipo_cor }};
                                     color:#fff;font-size:.72rem;font-weight:800;
                                     text-transform:uppercase;letter-spacing:.08em;
                                     padding:.25em .7em;border-radius:3px;margin-bottom:.75rem">
                            {{ $evento->tipo_label }}
                        </span>
                        @if($evento->destaque)
                            <span style="display:inline-block;background:#c9a84c;color:#fff;
                                         font-size:.72rem;font-weight:800;text-transform:uppercase;
                                         padding:.25em .7em;border-radius:3px;
                                         margin-bottom:.75rem;margin-left:.4rem">
                                &#9733; Destaque
                            </span>
                        @endif

                        {{-- Título --}}
                        <h1 style="font-size:1.9rem;font-weight:800;color:#1a1a2e;
                                   line-height:1.25;margin:0 0 1rem;
                                   border-left:5px solid {{ $evento->tipo_cor }};
                                   padding-left:.85rem">
                            {{ $evento->titulo }}
                        </h1>

                        {{-- Meta --}}
                        <div style="display:flex;flex-wrap:wrap;gap:1.25rem;
                                    align-items:center;font-size:.83rem;color:#888">
                            <span>&#128197; {{ $evento->dia_semana }},
                                {{ $evento->data_inicio->format('d') }} de
                                {{ $evento->mes_extenso }} de
                                {{ $evento->data_inicio->format('Y') }}
                                @if($evento->is_multi_dia)
                                    até {{ $evento->data_fim->format('d/m/Y') }}
                                @endif
                            </span>
                            @if($evento->horario_inicio)
                                <span>
                                    &#9200;
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $evento->horario_inicio)->format('H\hi') }}
                                    @if($evento->horario_encerramento)
                                        às {{ \Carbon\Carbon::createFromFormat('H:i:s', $evento->horario_encerramento)->format('H\hi') }}
                                    @endif
                                </span>
                            @endif
                            @if($evento->aberto_publico)
                                <span style="color:#2e7d32;font-weight:700">
                                    &#128101; Aberto ao público
                                </span>
                            @endif
                        </div>
                    </header>

                    {{-- Foto de capa --}}
                    @if($evento->foto_capa)
                        <img src="{{ asset('storage/'.$evento->foto_capa) }}"
                             style="width:100%;max-height:480px;object-fit:cover;display:block"
                             alt="{{ $evento->titulo }}">
                    @endif

                    {{-- Box de informações rápidas --}}
                    <div class="ev-info-box">
                        {{-- Data --}}
                        <div class="ev-info-item">
                            <i class="fa fa-calendar"></i>
                            <div>
                                <span class="ev-info-label">Data</span>
                                <span class="ev-info-valor">{{ $evento->periodo }}</span>
                            </div>
                        </div>

                        {{-- Horário --}}
                        @if($evento->horario_inicio)
                            <div class="ev-info-item">
                                <i class="fa fa-clock-o"></i>
                                <div>
                                    <span class="ev-info-label">Horário</span>
                                    <span class="ev-info-valor">
                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $evento->horario_inicio)->format('H\hi') }}
                                        @if($evento->horario_encerramento)
                                            às {{ \Carbon\Carbon::createFromFormat('H:i:s', $evento->horario_encerramento)->format('H\hi') }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @endif

                        {{-- Local --}}
                        @if($evento->local_nome)
                            <div class="ev-info-item">
                                <i class="fa fa-map-marker"></i>
                                <div>
                                    <span class="ev-info-label">Local</span>
                                    <span class="ev-info-valor">{{ $evento->local_nome }}</span>
                                    @if($evento->local_endereco)
                                        <span style="color:rgba(255,255,255,.7);font-size:.82rem;display:block">
                                            {{ $evento->local_endereco }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Tipo --}}
                        <div class="ev-info-item">
                            <i class="fa fa-star"></i>
                            <div>
                                <span class="ev-info-label">Tipo</span>
                                <span class="ev-info-valor">{{ $evento->tipo_label }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Box de inscrição/ingresso --}}
                    @if($evento->link_inscricao)
                        <div class="ev-inscricao-box">
                            <h4>&#127915; Participar do Evento</h4>
                            <p style="font-size:.95rem;color:#555;margin:0">
                                Clique no botão abaixo para se inscrever ou adquirir seu convite.
                                As vagas podem ser limitadas — garanta a sua!
                            </p>
                            <a href="{{ $evento->link_inscricao }}" target="_blank"
                               class="ev-inscricao-btn">
                                &#128279; Inscrever-se / Adquirir Convite
                            </a>
                        </div>
                    @endif

                    {{-- Conteúdo completo do evento --}}
                    @if($evento->conteudo)
                        <div class="nd-artigo-conteudo">
                            {!! $evento->conteudo !!}
                        </div>
                    @elseif($evento->descricao)
                        <div class="nd-artigo-conteudo">
                            <p>{{ $evento->descricao }}</p>
                        </div>
                    @endif

                    {{-- Links de mapa --}}
                    @if($evento->link_maps || $evento->link_waze)
                        <div class="ev-map-row">
                            <span style="font-size:.85rem;color:#888;align-self:center">
                                &#128205; Como chegar:
                            </span>
                            @if($evento->link_maps)
                                <a href="{{ $evento->link_maps }}" target="_blank"
                                   class="ev-map-btn" style="background:#4285f4;color:#fff">
                                    &#128506; Google Maps
                                </a>
                            @endif
                            @if($evento->link_waze)
                                <a href="{{ $evento->link_waze }}" target="_blank"
                                   class="ev-map-btn" style="background:#33ccff;color:#111">
                                    &#9992; Waze
                                </a>
                            @endif
                        </div>
                    @endif

                    {{-- Rodapé: compartilhar + voltar --}}
                    <footer class="nd-artigo-rodape">
                        <div class="nd-compartilhar">
                            <span>Compartilhar:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('/eventos/'.$evento->slug)) }}"
                               target="_blank" class="nd-share-btn nd-share-fb" title="Facebook">f</a>
                            <a href="https://wa.me/?text={{ urlencode($evento->titulo.' '.url('/eventos/'.$evento->slug)) }}"
                               target="_blank" class="nd-share-btn nd-share-wa" title="WhatsApp">&#128172;</a>
                        </div>
                        <a href="/noticias" class="nd-btn nd-btn-voltar">
                            &#10094; Voltar para Notícias
                        </a>
                    </footer>

                </article>
            </div>

            {{-- ════════════════════════════
                 SIDEBAR
                 ════════════════════════════ --}}
            <aside class="nd-col-sidebar">

                {{-- Navegação --}}
                <div class="nd-sidebar-card">
                    <div class="nd-sidebar-header">
                        <span>&#9670;</span> Navegação
                    </div>
                    <div class="nd-sidebar-links">
                        <a href="/" class="nd-sidebar-link">
                            <span class="nd-sidebar-link-icone" style="background:#e8f0fe;color:#1a3a5c">&#8962;</span>
                            Página Inicial
                        </a>
                        <a href="/noticias" class="nd-sidebar-link">
                            <span class="nd-sidebar-link-icone" style="background:#e8f0fe;color:#1a3a5c">&#128240;</span>
                            Notícias
                        </a>
                        <a href="/galeria" class="nd-sidebar-link">
                            <span class="nd-sidebar-link-icone" style="background:#e6f4ea;color:#2e7d32">&#128247;</span>
                            Galeria de Fotos
                        </a>
                        <a href="/sobre-nos" class="nd-sidebar-link">
                            <span class="nd-sidebar-link-icone" style="background:#fff3e0;color:#e65100">&#9670;</span>
                            Sobre a Loja
                        </a>
                    </div>
                </div>

                {{-- Outros eventos --}}
                @if($outrosEventos->count() > 0)
                    <div class="nd-sidebar-card">
                        <div class="nd-sidebar-header">
                            <span>&#9670;</span> Próximos Eventos
                        </div>
                        @foreach($outrosEventos as $outro)
                            <a href="/eventos/{{ $outro->slug }}" class="nd-sidebar-evento">
                                {{-- Thumbnail --}}
                                @if($outro->foto_capa)
                                    <img src="{{ asset('storage/'.$outro->foto_capa) }}"
                                         class="nd-sidebar-evento-thumb"
                                         alt="{{ $outro->titulo }}">
                                @else
                                    <div class="nd-sidebar-evento-sem-foto"
                                         style="background:{{ $outro->tipo_cor }}18">
                                        <span style="color:{{ $outro->tipo_cor }}">&#128197;</span>
                                    </div>
                                @endif
                                {{-- Texto --}}
                                <div>
                                    <p class="nd-sidebar-evento-titulo">
                                        {{ \Illuminate\Support\Str::limit($outro->titulo, 55) }}
                                    </p>
                                    <span class="nd-sidebar-evento-data">
                                        &#128197; {{ $outro->periodo }}
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif

                {{-- Box de inscrição repetido na sidebar para fácil acesso --}}
                @if($evento->link_inscricao)
                    <div class="nd-sidebar-card">
                        <div class="nd-sidebar-header">
                            <span>&#9670;</span> Participar
                        </div>
                        <div style="padding:1.25rem">
                            <p style="font-size:.9rem;color:#555;margin:0 0 .75rem">
                                Garanta sua participação neste evento!
                            </p>
                            <a href="{{ $evento->link_inscricao }}" target="_blank"
                               style="display:block;background:#1a3a5c;color:#fff;
                                      text-align:center;padding:.7rem 1rem;
                                      border-radius:6px;font-weight:700;
                                      text-decoration:none;font-size:.95rem">
                                &#128279; Inscrever-se
                            </a>
                        </div>
                    </div>
                @endif

                {{-- Endereço e mapas --}}
                @if($evento->local_nome)
                    <div class="nd-sidebar-card">
                        <div class="nd-sidebar-header">
                            <span>&#9670;</span> Local do Evento
                        </div>
                        <div style="padding:1.1rem">
                            <p style="font-size:.9rem;color:#555;margin:0 0 .75rem">
                                <strong style="color:#1a3a5c">{{ $evento->local_nome }}</strong>
                                @if($evento->local_endereco)
                                    <br><span style="font-size:.85rem">{{ $evento->local_endereco }}</span>
                                @endif
                            </p>
                            <div style="display:flex;flex-direction:column;gap:.5rem">
                                @if($evento->link_maps)
                                    <a href="{{ $evento->link_maps }}" target="_blank"
                                       style="display:flex;align-items:center;gap:.5rem;
                                              background:#4285f4;color:#fff;padding:.5rem .9rem;
                                              border-radius:5px;font-size:.88rem;font-weight:600;
                                              text-decoration:none">
                                        &#128506; Abrir no Google Maps
                                    </a>
                                @endif
                                @if($evento->link_waze)
                                    <a href="{{ $evento->link_waze }}" target="_blank"
                                       style="display:flex;align-items:center;gap:.5rem;
                                              background:#33ccff;color:#111;padding:.5rem .9rem;
                                              border-radius:5px;font-size:.88rem;font-weight:600;
                                              text-decoration:none">
                                        &#9992; Abrir no Waze
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

            </aside>

        </div>
    </div>
</section>

@include('landing.layouts.footer')