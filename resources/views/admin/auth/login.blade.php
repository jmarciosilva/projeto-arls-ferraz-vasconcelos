<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Login Administrativo - ARLS Ferraz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ============================================================
        FUNDO + OVERLAY
        ============================================================ */
        body {
            background: url('/images/banner_002.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }

        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.65);
            z-index: 0;
        }

        /* ============================================================
        CARD LOGIN
        ============================================================ */
        .login-card {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(8px);
            padding: 28px;
        }

        /* ============================================================
        LOGO / TEXTO
        ============================================================ */
        .logo {
            width: 120px;
            height: 120px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .titulo {
            font-weight: bold;
            color: #1a3a5c;
            font-size: 1.2rem;
        }

        .subtitulo {
            color: #777;
            font-size: 0.85rem;
        }

        /* ============================================================
        INPUTS
        ============================================================ */
        .form-control {
            font-size: 16px;
            /* evita zoom no iPhone */
            padding: 10px;
        }

        /* ============================================================
        BOTÃO
        ============================================================ */
        .btn-login {
            background: #1a3a5c;
            border: none;
            padding: 12px;
            transition: 0.2s;
        }

        .btn-login:hover {
            background: #142c45;
        }

        /* ============================================================
        LINK
        ============================================================ */
        .link-recuperar {
            font-size: 0.8rem;
            text-decoration: none;
        }

        .link-recuperar:hover {
            text-decoration: underline;
        }

        /* ============================================================
        MOBILE
        ============================================================ */
        @media (max-width: 576px) {

            body {
                align-items: flex-start;
                padding-top: 40px;
            }

            .login-card {
                padding: 22px;
            }

            .logo {
                width: 100px;
                height: 100px;
            }

            .titulo {
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body>

    {{-- Overlay escuro --}}
    <div class="overlay"></div>

    {{-- CARD LOGIN --}}
    <div class="card login-card shadow-lg">

        <div class="text-center">

            {{-- LOGO --}}
            <img src="/images/logo.png" class="logo">

            <h5 class="titulo mb-1">ARLS Ferraz de Vasconcelos</h5>
            <p class="subtitulo mb-4">Painel Administrativo</p>

        </div>

        {{-- ============================================================
        ALERTA DE ERROS
        ============================================================ --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Corrija os erros:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ============================================================
        FORMULÁRIO
        ============================================================ --}}
        <form method="POST" action="/admin/login">
            @csrf

            {{-- EMAIL --}}
            <div class="mb-3">
                <input name="email" type="email" placeholder="E-mail"
                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- SENHA COM VISUALIZAR --}}
            <div class="mb-2 position-relative">
                <input id="password" name="password" type="password" placeholder="Senha" class="form-control" required>

                {{-- Botão mostrar senha --}}
                <span onclick="toggleSenha()"
                    style="position:absolute;right:10px;top:50%;transform:translateY(-50%);cursor:pointer;font-size:14px;">
                    👁️
                </span>
            </div>

            {{-- LEMBRAR + RECUPERAR --}}
            <div class="d-flex justify-content-between align-items-center mb-3">

                <div class="form-check">
                    <input name="remember" type="checkbox" class="form-check-input" id="rem">
                    <label class="form-check-label" for="rem">Lembrar</label>
                </div>

                <a href="/admin/recuperar-senha" class="link-recuperar">
                    Esqueci minha senha
                </a>

            </div>

            {{-- BOTÃO --}}
            <button id="btnLogin" class="btn btn-login w-100 text-white">
                Entrar
            </button>

        </form>

    </div>

    {{-- ============================================================
    SCRIPT UX
    ============================================================ --}}
    <script>
        // Mostrar / ocultar senha
        function toggleSenha() {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        }

        // Loading ao clicar no botão
        document.querySelector("form").addEventListener("submit", function() {
            const btn = document.getElementById("btnLogin");
            btn.innerText = "Entrando...";
            btn.disabled = true;
        });
    </script>

</body>

</html>
