<!DOCTYPE html>
<html lang="it" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Restiamo in contatto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main class="container py-4" style="max-width: 480px;">
        <h1 class="h3 mb-2">Restiamo in contatto</h1>
        <p class="text-secondary mb-4">
            Lascia nome e numero: ti aggiungeremo al gruppo per continuare insieme la mobilitazione.
        </p>

        <form method="POST" action="{{ route('contatti.store') }}">
            @csrf

            {{-- Honeypot: nascosto alle persone, i bot lo compilano --}}
            <div style="position: absolute; left: -9999px;" aria-hidden="true">
                <label for="sito">Non compilare questo campo</label>
                <input type="text" id="sito" name="sito" tabindex="-1" autocomplete="off">
            </div>

            <div class="mb-3">
                <label for="nome" class="form-label">Nome (anche solo il nome di battaglia)</label>
                <input type="text" id="nome" name="nome" value="{{ old('nome') }}" maxlength="60" required
                    autocomplete="given-name" class="form-control form-control-lg @error('nome') is-invalid @enderror">
                @error('nome')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Numero di telefono</label>
                <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}" maxlength="30" required
                    inputmode="tel" autocomplete="tel"
                    class="form-control form-control-lg @error('telefono') is-invalid @enderror">
                @error('telefono')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <p class="small text-secondary">
                Il tuo numero serve solo per aggiungerti al gruppo e verra' cancellato dopo l'iniziativa.
                Non viene condiviso con nessuno.
            </p>

            <button type="submit" class="btn btn-warning btn-lg w-100">Invia il mio contatto</button>
        </form>
    </main>
</body>

</html>
