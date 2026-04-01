{{--
    Componente: landing/components/eventos.blade.php
    Descrição: Seção de eventos exibida na home da landing page
--}}
@if (isset($eventos) && $eventos->count() > 0)
    <style>
        .eventos-section {
            background: #fff;
            padding: 4rem 0;
        }

        .ev-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
            justify-content: center;
            margin-top: 2.5rem;
        }

        .ev-card {
            width: 340px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, .08);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform .22s, box-shadow .22s;
        }

        .ev-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 28px rgba(0, 0, 0, .14);
        }

        .ev-card-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
        }

        .ev-card-sem-foto {
            width: 100%;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
        }

        .ev-card-body {
            padding: 1.25rem 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .ev-tipo-badge {
            display: inline-block;
            font-size: .72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .07em;
            padding: .25em .7em;
            border-radius: 4px;
            color: #fff;
            margin-bottom: .6rem;
        }

        .ev-titulo {
            font-size: 1.1rem;
            font-weight: 800;
            color: #1a1a2e;
            line-height: 1.35;
            margin: 0 0 .75rem;
        }

        .ev-info {
            display: flex;
            align-items: flex-start;
            gap: .5rem;
            font-size: .88rem;
            color: #555;
            margin-bottom: .4rem;
        }

        .ev-info i {
            color: #1a3a5c;
            font-size: .95rem;
            width: 16px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .ev-card-footer {
            padding: .9rem 1.5rem;
            border-top: 1px solid #f0f0f0;
            background: #fafafa;
            display: flex;
            gap: .6rem;
            flex-wrap: wrap;
        }

        .ev-map-btn {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .4rem .85rem;
            border-radius: 5px;
            font-size: .82rem;
            font-weight: 600;
            text-decoration: none;
            transition: opacity .18s;
        }

        .ev-map-btn:hover {
            opacity: .85;
        }

        .ev-inscricao-btn {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .4rem 1rem;
            border-radius: 5px;
            font-size: .85rem;
            font-weight: 700;
            text-decoration: none;
            background: #1a3a5c;
            color: #fff;
            margin-top: auto;
            transition: background .18s;
        }

        .ev-inscricao-btn:hover {
            background: #0f2540;
            color: #fff;
        }

        .ev-destaque-ribbon {
            position: absolute;
            top: 12px;
            right: -8px;
            background: #c9a84c;
            color: #fff;
            font-size: .72rem;
            font-weight: 800;
            text-transform: uppercase;
            padding: .3em .9em;
            border-radius: 4px 0 0 4px;
            box-shadow: 2px 2px 6px rgba(0, 0, 0, .2);
        }

        .ev-publico-badge {
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            font-size: .75rem;
            font-weight: 700;
            color: #2e7d32;
            background: #e8f5e9;
            padding: .2em .6em;
            border-radius: 4px;
            margin-top: .4rem;
        }
    </style>

    <section class="eventos-section">
        <div class="container">

            <div class="section_title text-center mb-0">
                <span>Agenda da Loja</span>
                <h3>Próximos Eventos da<br>ARLS Ferraz de Vasconcelos</h3>
            </div>

            <div class="ev-grid">
                @foreach ($eventos as $evento)
                    @php
                        $meses = [
                            '',
                            'Jan',
                            'Fev',
                            'Mar',
                            'Abr',
                            'Mai',
                            'Jun',
                            'Jul',
                            'Ago',
                            'Set',
                            'Out',
                            'Nov',
                            'Dez',
                        ];
                    @endphp
                    <div class="ev-card" style="position:relative">

                        {{-- Ribbon de destaque --}}
                        @if ($evento->destaque)
                            <span class="ev-destaque-ribbon">&#9733; Destaque</span>
                        @endif

                        {{-- Foto ou fundo colorido — agora clicável --}}
                        @if ($evento->foto_capa)
                            <a href="/eventos/{{ $evento->slug }}">
                                <img src="{{ asset('storage/' . $evento->foto_capa) }}" class="ev-card-img"
                                    alt="{{ $evento->titulo }}">
                            </a>
                        @else
                            <a href="/eventos/{{ $evento->slug }}" class="ev-card-sem-foto"
                                style="background:{{ $evento->tipo_cor }}18;text-decoration:none">
                                <span style="color:{{ $evento->tipo_cor }}">&#128197;</span>
                            </a>
                        @endif

                        <div class="ev-card-body">

                            {{-- Tipo --}}
                            <span class="ev-tipo-badge" style="background:{{ $evento->tipo_cor }}">
                                {{ $evento->tipo_label }}
                            </span>

                            {{-- Título clicável --}}
                            <h3 class="ev-titulo">
                                <a href="/eventos/{{ $evento->slug }}" style="text-decoration:none;color:inherit">
                                    {{ $evento->titulo }}
                                </a>
                            </h3>

                            {{-- Data --}}
                            <div class="ev-info">
                                <i class="fa fa-calendar"></i>
                                <span>
                                    {{ $evento->dia_semana }},
                                    {{ $evento->data_inicio->format('d') }} de
                                    {{ ['', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'][(int) $evento->data_inicio->format('n')] }}
                                    de {{ $evento->data_inicio->format('Y') }}
                                    @if ($evento->is_multi_dia)
                                        até {{ $evento->data_fim->format('d/m/Y') }}
                                    @endif
                                </span>
                            </div>

                            {{-- Horário --}}
                            @if ($evento->horario_inicio)
                                <div class="ev-info">
                                    <i class="fa fa-clock-o"></i>
                                    <span>
                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $evento->horario_inicio)->format('H\hi') }}
                                        @if ($evento->horario_encerramento)
                                            às
                                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $evento->horario_encerramento)->format('H\hi') }}
                                        @endif
                                    </span>
                                </div>
                            @endif

                            {{-- Local --}}
                            @if ($evento->local_nome)
                                <div class="ev-info">
                                    <i class="fa fa-map-marker"></i>
                                    <span>{{ $evento->local_nome }}</span>
                                </div>
                            @endif

                            {{-- Descrição resumida --}}
                            @if ($evento->descricao)
                                <p style="font-size:.88rem;color:#777;line-height:1.55;margin:.5rem 0 0">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($evento->descricao), 100) }}
                                </p>
                            @endif

                            {{-- Aberto ao público --}}
                            @if ($evento->aberto_publico)
                                <span class="ev-publico-badge">
                                    <i class="fa fa-users"></i> Aberto ao público
                                </span>
                            @endif

                            {{-- Botão de inscrição --}}
                            @if ($evento->link_inscricao)
                                <a href="{{ $evento->link_inscricao }}" target="_blank" class="ev-inscricao-btn mt-3">
                                    <i class="fa fa-sign-in"></i> Fazer Inscrição
                                </a>
                            @endif

                        </div>

                        {{-- Botão "Ver detalhes" no rodapé do card --}}
                        {{-- Adicione dentro de .ev-card-footer, ao lado dos botões de mapa: --}}
                        <a href="/eventos/{{ $evento->slug }}"
                            style="margin-right:auto;display:inline-flex;align-items:center;gap:.35rem;
                                font-size:.85rem;font-weight:700;color:#1a3a5c;text-decoration:none;
                                border-bottom:2px solid #c9a84c;padding-bottom:1px">
                            Ver detalhes &#8594;
                        </a>



                        {{-- Links de mapa --}}
                        @if ($evento->link_maps || $evento->link_waze)
                            <div class="ev-card-footer">

                                @if ($evento->link_maps)
                                    <a href="{{ $evento->link_maps }}" target="_blank" class="ev-map-btn"
                                        style="background:#4285f4;color:#fff">
                                        <i class="fa fa-map"></i> Google Maps
                                    </a>
                                @endif
                                @if ($evento->link_waze)
                                    <a href="{{ $evento->link_waze }}" target="_blank" class="ev-map-btn"
                                        style="background:#33ccff;color:#111">
                                        <i class="fa fa-location-arrow"></i> Waze
                                    </a>
                                @endif
                            </div>
                        @endif

                    </div>
                @endforeach
            </div>

        </div>
    </section>

@endif
