@include('landing.layouts.header')

<body>
    @include('landing.components.navbar')

    @include('landing.components.slider')

    @include('landing.components.features')

    @include('landing.components.about')

    @include('landing.components.eventos')      {{-- Eventos --}}

    {{-- Calendário de próximas sessões --}}
    @include('landing.components.calendario')

    @include('landing.components.offers')

    @include('landing.components.localizacao')

    @include('landing.layouts.footer')