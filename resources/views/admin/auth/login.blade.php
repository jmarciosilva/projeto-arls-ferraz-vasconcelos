<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Login Admin - ARLS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark d-flex align-items-center justify-content-center" style="min-height:100vh">
    <div class="card shadow" style="width:380px">
        <div class="card-body p-4">
            <h5 class="text-center mb-1">ARLS Ferraz de Vasconcelos</h5>
            <p class="text-center text-muted small mb-4">Painel Administrativo</p>
            <form method="POST" action="/admin/login">
                @csrf
                <div class="mb-3">
                    <input name="email" type="email" placeholder="E-mail"
                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input name="password" type="password" placeholder="Senha" class="form-control" required>
                </div>
                <div class="mb-3 form-check">
                    <input name="remember" type="checkbox" class="form-check-input" id="rem">
                    <label class="form-check-label" for="rem">Lembrar de mim</label>
                </div>
                <button class="btn btn-primary w-100">Entrar</button>
            </form>
        </div>
    </div>
</body>

</html>
