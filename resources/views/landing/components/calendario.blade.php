{{--
    Componente: landing/components/calendario.blade.php
    Descrição: Calendário de sessões exibido na home da landing page
    Mesmo padrão visual do template original (dark/azul maçônico)
--}}
@if (isset($sessoes) && $sessoes->count() > 0)

    <style>
        /* ── Seção do calendário ─────────────────────────── */
        .calendario-section {
            background: #f4f5f7;
            padding: 4rem 0;
        }

        .calendario-section .section-title span {
            color: #c9a84c;
        }

        /* Grid de cards de sessão */
        .sessoes-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 2.5rem;
        }

        .sessao-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, .08);
            overflow: hidden;
            width: 340px;
            display: flex;
            flex-direction: column;
            border-top: 4px solid #1a3a5c;
            transition: transform .22s, box-shadow .22s;
        }

        .sessao-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 28px rgba(0, 0, 0, .14);
        }

        /* Cabeçalho colorido com a data */
        .sessao-card-header {
            background: linear-gradient(135deg, #1a3a5c, #2c5f8a);
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .sessao-dia {
            text-align: center;
            background: #c9a84c;
            color: #fff;
            border-radius: 8px;
            padding: .4rem .75rem;
            min-width: 62px;
            flex-shrink: 0;
        }

        .sessao-dia-num {
            font-size: 1.8rem;
            font-weight: 900;
            line-height: 1;
        }

        .sessao-dia-mes {
            font-size: .72rem;
            text-transform: uppercase;
            letter-spacing: .06em;
            font-weight: 700;
        }

        .sessao-dia-semana {
            font-size: .7rem;
            opacity: .85;
            margin-top: .1rem;
        }

        .sessao-header-info {
            flex: 1;
        }

        .sessao-grau-badge {
            display: inline-block;
            font-size: .7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .08em;
            padding: .2em .6em;
            border-radius: 4px;
            margin-bottom: .3rem;
        }

        .sessao-nome-card {
            color: #fff;
            font-size: 1rem;
            font-weight: 700;
            line-height: 1.35;
            margin: 0;
        }

        /* Corpo do card */
        .sessao-card-body {
            padding: 1.1rem 1.5rem 1.25rem;
            flex: 1;
        }

        .sessao-info-row {
            display: flex;
            align-items: center;
            gap: .5rem;
            font-size: .9rem;
            color: #555;
            margin-bottom: .5rem;
        }

        .sessao-info-row i {
            color: #1a3a5c;
            font-size: 1rem;
            width: 18px;
            flex-shrink: 0;
        }

        /* Rodapé com links de mapa */
        .sessao-card-footer {
            padding: .9rem 1.5rem;
            border-top: 1px solid #f0f0f0;
            background: #fafafa;
            display: flex;
            gap: .6rem;
            flex-wrap: wrap;
        }

        .sessao-map-btn {
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

        .sessao-map-btn:hover {
            opacity: .85;
        }

        .sessao-map-gmaps {
            background: #4285f4;
            color: #fff;
        }

        .sessao-map-waze {
            background: #33ccff;
            color: #111;
        }
    </style>

    <section class="calendario-section">
        <div class="container">

            {{-- Título da seção --}}
            <div class="section_title text-center mb-0">
                <span>Calendário da Loja</span>
                <h3>Próximas Sessões da<br>ARLS Ferraz de Vasconcelos</h3>
                <p style="color:#777;font-size:.95rem;margin-top:.75rem">
                    <i class="fa fa-map-marker me-1" style="color:#c9a84c"></i>
                    Templo Antônio Latuf Cury —
                    R. Jorn. Sebastião Souza Lemos, 240 — Jardim Pérola, Ferraz de Vasconcelos/SP
                </p>
            </div>

            {{-- Grade de sessões --}}
            <div class="sessoes-grid">
                @foreach ($sessoes as $sessao)
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
                        $grauCores = [
                            1 => ['bg' => '#ffc107', 'color' => '#333'],
                            2 => ['bg' => '#0dcaf0', 'color' => '#333'],
                            3 => ['bg' => '#0d6efd', 'color' => '#fff'],
                        ];
                        $gc = $grauCores[$sessao->grau] ?? ['bg' => '#6c757d', 'color' => '#fff'];
                    @endphp
                    <div class="sessao-card">

                        {{-- Cabeçalho: data + nome --}}
                        <div class="sessao-card-header">
                            {{-- Bloco da data --}}
                            <div class="sessao-dia">
                                <div class="sessao-dia-num">{{ $sessao->data->format('d') }}</div>
                                <div class="sessao-dia-mes">{{ $meses[(int) $sessao->data->format('n')] }}</div>
                                <div class="sessao-dia-semana">{{ $sessao->data->format('Y') }}</div>
                            </div>
                            {{-- Grau e nome --}}
                            <div class="sessao-header-info">
                                <span class="sessao-grau-badge"
                                    style="background:{{ $gc['bg'] }};color:{{ $gc['color'] }}">
                                    {{ $sessao->grau }}° Grau
                                </span>
                                <p class="sessao-nome-card">{{ $sessao->nome }}</p>
                            </div>
                        </div>

                        {{-- Corpo: horário, rito, dia da semana --}}
                        <div class="sessao-card-body">
                            <div class="sessao-info-row">
                                <i class="fa fa-calendar"></i>
                                <span>{{ $sessao->dia_semana }}, {{ $sessao->data->format('d/m/Y') }}</span>
                            </div>
                            <div class="sessao-info-row">
                                <i class="fa fa-clock-o"></i>
                                <span>
                                    Início:
                                    <strong>{{ \Carbon\Carbon::createFromFormat('H:i:s', $sessao->horario_inicio)->format('H\hi') }}</strong>
                                    @if ($sessao->horario_encerramento)
                                        &nbsp;—&nbsp; Encerramento previsto:
                                        <strong>{{ \Carbon\Carbon::createFromFormat('H:i:s', $sessao->horario_encerramento)->format('H\hi') }}</strong>
                                    @endif
                                </span>
                            </div>
                            <div class="sessao-info-row">
                                <i class="fa fa-star"></i>
                                <span>{{ $sessao->rito }}</span>
                            </div>
                            @if ($sessao->observacoes)
                                <div class="sessao-info-row" style="align-items:flex-start">
                                    <i class="fa fa-info-circle" style="margin-top:3px"></i>
                                    <span style="color:#888;font-size:.85rem">{{ $sessao->observacoes }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- Rodapé: botões de mapa --}}
                        <div class="sessao-card-footer">
                            {{-- <span style="font-size:.8rem;color:#aaa;align-self:center;margin-right:auto">
                                <i class="fa fa-map-marker me-1"></i>Como chegar:
                            </span> --}}
                            <a href="https://maps.app.goo.gl/TpZyhLZBMjS9s9Pi9" target="_blank"
                                class="sessao-map-btn sessao-map-gmaps" title="Abrir no Google Maps">
                                <i class="fa fa-map"></i> Google Maps
                            </a>
                            <a href="https://waze.com/ul?q=R.+Jorn.+Sebasti%C3%A3o+Souza+Lemos+240+Ferraz+de+Vasconcelos+SP&navigate=yes"
                                target="_blank" class="sessao-map-btn sessao-map-waze" title="Abrir no Waze">
                                <i class="fa fa-location-arrow"></i> Waze
                            </a>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </section>

@endif
