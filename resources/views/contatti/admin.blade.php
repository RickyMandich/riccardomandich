<!DOCTYPE html>
<html lang="it" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="referrer" content="no-referrer">
    <title>Contatti raccolti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #qr-box {
            background: #fff;
            color: #000;
            border-radius: 12px;
            padding: 16px;
            display: inline-block;
        }

        #qr {
            display: inline-block;
        }

        #qr img,
        #qr canvas {
            max-width: 100%;
            height: auto !important;
        }

        /* In stampa resta visibile solo il QR code */
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: #fff !important;
                color: #000 !important;
            }

            #qr-box {
                padding: 0;
            }

            #qr img,
            #qr canvas {
                width: 16cm !important;
            }
        }
    </style>
</head>

<body>
    @php
        $righe = $contatti->map(fn ($c) => $c->nome . ' ' . $c->telefono)->values();
    @endphp

    <main class="container py-4" style="max-width: 720px;">
        <div class="text-center mb-4">
            <div id="qr-box">
                <div id="qr"></div>
                <p class="mb-0 mt-2 fw-bold">Lascia il tuo contatto per restare in gruppo</p>
                <p class="mb-0 small">{{ $formUrl }}</p>
            </div>
            <div class="mt-3 no-print">
                <button type="button" class="btn btn-outline-light" onclick="window.print()">Stampa il QR</button>
            </div>
        </div>

        <div class="no-print">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                <h1 class="h4 mb-0">Contatti raccolti: {{ $contatti->count() }}</h1>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('contatti.admin', [$param => $key]) }}"
                        class="btn btn-outline-secondary">Aggiorna</a>
                    <button type="button" id="copia" class="btn btn-outline-light">Copia lista</button>
                    <a href="{{ route('contatti.vcf', [$param => $key]) }}" class="btn btn-warning">Scarica .vcf</a>
                    <button type="button" id="condividi" class="btn btn-outline-info">Condividi pagina admin</button>
                </div>
            </div>
            <p class="small text-secondary">
                Il link di condivisione contiene la chiave: chi lo riceve puo' vedere ed eliminare tutti i contatti.
                Mandalo solo a chi raccoglie i numeri con te.
            </p>

            @if ($contatti->isEmpty())
                <p class="text-secondary">Ancora nessun contatto.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-sm align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Telefono</th>
                                <th>Ora</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contatti as $c)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $c->nome }}</td>
                                    <td><a href="tel:{{ $c->telefono }}"
                                            class="text-info text-decoration-none">{{ $c->telefono }}</a></td>
                                    <td>{{ $c->created_at->timezone('Europe/Rome')->format('H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <form method="POST" action="{{ route('contatti.svuota') }}" class="mt-4"
                onsubmit="return confirm('Cancellare tutti i contatti? L\'operazione non si puo\' annullare.');">
                @csrf
                <input type="hidden" name="{{ $param }}" value="{{ $key }}">
                <button type="submit" class="btn btn-outline-danger">Svuota tutto</button>
            </form>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        new QRCode(document.getElementById('qr'), {
            text: @json($formUrl),
            width: 480,
            height: 480,
            colorDark: '#000000',
            colorLight: '#ffffff',
            correctLevel: QRCode.CorrectLevel.M
        });

        const copia = document.getElementById('copia');
        if (copia) {
            copia.addEventListener('click', async () => {
                const righe = @json($righe);
                try {
                    await navigator.clipboard.writeText(righe.join('\n'));
                    copia.textContent = 'Copiato!';
                } catch (e) {
                    copia.textContent = 'Copia non riuscita';
                }
                setTimeout(() => copia.textContent = 'Copia lista', 2000);
            });
        }

        // Condivisione del link admin (chiave compresa): menu di condivisione del telefono,
        // altrimenti copia negli appunti.
        const condividi = document.getElementById('condividi');
        if (condividi) {
            condividi.addEventListener('click', async () => {
                const url = @json($adminUrl);

                if (navigator.share) {
                    try {
                        await navigator.share({
                            title: 'Contatti raccolti',
                            text: 'Pagina per vedere i contatti raccolti:',
                            url: url
                        });
                        return;
                    } catch (e) {
                        if (e && e.name === 'AbortError') return;
                    }
                }

                try {
                    await navigator.clipboard.writeText(url);
                    condividi.textContent = 'Link copiato!';
                } catch (e) {
                    window.prompt('Copia il link:', url);
                }
                setTimeout(() => condividi.textContent = 'Condividi pagina admin', 2000);
            });
        }
    </script>
</body>

</html>
