<?php

namespace App\Http\Controllers;

use App\Models\Contatto;
use App\Services\ContattiAdminKey;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContattiController extends Controller
{
    /**
     * Form pubblico (raggiunto tramite QR code).
     */
    public function form(): View
    {
        return view('contatti.form');
    }

    /**
     * Salva nome e numero. Un numero gia' presente aggiorna solo il nome.
     */
    public function store(Request $request): RedirectResponse
    {
        // Honeypot: i bot compilano il campo nascosto, le persone no.
        if ($request->filled('sito')) {
            return redirect()->route('contatti.grazie');
        }

        $dati = $request->validate([
            'nome' => 'required|string|max:60',
            'telefono' => 'required|string|max:30',
        ]);

        $telefono = Contatto::normalizzaTelefono($dati['telefono']);

        if ($telefono === null) {
            return back()
                ->withInput()
                ->withErrors(['telefono' => 'Il numero non sembra valido, controlla e riprova.']);
        }

        Contatto::updateOrCreate(
            ['telefono' => $telefono],
            ['nome' => trim($dati['nome'])]
        );

        return redirect()->route('contatti.grazie');
    }

    /**
     * Conferma dopo l'invio.
     */
    public function grazie(): View
    {
        return view('contatti.grazie');
    }

    /**
     * Area admin (/aadminn): QR da stampare, lista contatti, export, svuota, condivisione.
     * Senza chiave valida mostra il form per inserirla.
     */
    public function admin(Request $request): View|Response
    {
        $param = $this->paramChiave();

        if (!$this->chiaveValida($request)) {
            $inviata = $request->filled($param);

            return response()->view('contatti.admin-login', [
                'param' => $param,
                'errore' => $inviata,
            ], $inviata ? 403 : 200);
        }

        $key = (string) $request->input($param);

        return view('contatti.admin', [
            'contatti' => Contatto::orderBy('created_at')->get(),
            'param' => $param,
            'key' => $key,
            'formUrl' => route('contatti.form'),
            'adminUrl' => route('contatti.admin', [$param => $key]),
        ]);
    }

    /**
     * Export in formato vCard, importabile nella rubrica del telefono.
     */
    public function vcf(Request $request): Response
    {
        abort_unless($this->chiaveValida($request), 404);

        $vcf = Contatto::orderBy('created_at')->get()
            ->map(fn (Contatto $c) => implode("\r\n", [
                'BEGIN:VCARD',
                'VERSION:3.0',
                'FN:' . $this->vcfEscape($c->nome),
                'N:;' . $this->vcfEscape($c->nome) . ';;;',
                'TEL;TYPE=CELL:' . $c->telefono,
                'END:VCARD',
            ]))
            ->implode("\r\n");

        return response($vcf . "\r\n", 200, [
            'Content-Type' => 'text/vcard; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="contatti-corteo.vcf"',
        ]);
    }

    /**
     * Cancella tutti i contatti (da fare a fine iniziativa).
     */
    public function svuota(Request $request): RedirectResponse
    {
        abort_unless($this->chiaveValida($request), 404);

        Contatto::query()->delete();

        $param = $this->paramChiave();

        return redirect()->route('contatti.admin', [$param => (string) $request->input($param)]);
    }

    /**
     * Nome del parametro (GET o POST) che porta la chiave admin.
     */
    private function paramChiave(): string
    {
        return (string) config('contatti.key_param');
    }

    private function chiaveValida(Request $request): bool
    {
        return ContattiAdminKey::verifica($request->input($this->paramChiave()));
    }

    private function vcfEscape(string $valore): string
    {
        return str_replace(['\\', ';', ',', "\n", "\r"], ['\\\\', '\\;', '\\,', ' ', ''], $valore);
    }
}
