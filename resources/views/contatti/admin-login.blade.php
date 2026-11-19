<!DOCTYPE html>
<html lang="it" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="referrer" content="no-referrer">
    <title>Accesso riservato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main class="container py-5" style="max-width: 420px;">
        <h1 class="h4 mb-3">Accesso riservato</h1>

        @if ($errore)
            <div class="alert alert-danger" role="alert">Chiave non valida.</div>
        @endif

        <form method="GET" action="{{ route('contatti.admin') }}">
            <label for="chiave" class="form-label">Chiave di accesso</label>
            <input type="password" id="chiave" name="{{ $param }}" class="form-control form-control-lg mb-3"
                required autofocus autocomplete="current-password">
            <button type="submit" class="btn btn-warning btn-lg w-100">Entra</button>
        </form>
    </main>
</body>

</html>
