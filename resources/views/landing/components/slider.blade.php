{{-- slider_area_start --}}
<div class="slider_area">
    <div class="slider_active owl-carousel">

        @forelse($slides as $slide)
            <div class="single_slider d-flex align-items-center justify-content-center"
                @if ($slide->imagem) style="background-image: url('{{ asset('storage/' . $slide->imagem) }}'); background-size: cover; background-position: center;"
                 @else
                     class="single_slider d-flex align-items-center justify-content-center slider_bg_1" @endif>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="slider_text text-center">
                                <h3>{{ $slide->titulo }}</h3>
                                @if ($slide->subtitulo)
                                    <p>{{ $slide->subtitulo }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            {{-- Fallback estático caso o banco esteja vazio --}}
            <div class="single_slider d-flex align-items-center justify-content-center slider_bg_1">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="slider_text text-center">
                                <h3>Loja Maçônica</h3>
                                <p>A . ' . R . ' . L . ' . S . ' . Ferraz de Vasconcelos</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single_slider d-flex align-items-center justify-content-center slider_bg_2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="slider_text text-center">
                                <h3>Unidos pela verdade</h3>
                                <p style="color: white">Servindo à Comunidade</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single_slider d-flex align-items-center justify-content-center slider_bg_3">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="slider_text text-center">
                                <h3 style="color: white">Fortalecendo Laços</h3>
                                <p style="color: white">E construindo um futuro mais justo</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single_slider d-flex align-items-center justify-content-center slider_bg_2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="slider_text text-center">
                                <h3>Tradição e Virtude</h3>
                                <p>A serviço da humanidade</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse

    </div>
</div>
{{-- slider_area_end --}}
