<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Contatto raccolto tramite il form pubblico /contatti.
 *
 * @property string $nome
 * @property string $telefono Numero in formato internazionale (+39...)
 */
class Contatto extends Model
{
    protected $table = 'contatti';

    protected $fillable = [
        'nome',
        'telefono',
    ];

    /**
     * Normalizza un numero di telefono in formato internazionale.
     *
     * Accetta spazi, trattini, punti e parentesi. Senza prefisso internazionale
     * assume l'Italia (+39). Ritorna null se il numero non sembra valido.
     */
    public static function normalizzaTelefono(string $raw): ?string
    {
        $cifre = preg_replace('/\D/', '', $raw);
        $haPiu = str_starts_with(ltrim($raw), '+');

        if ($haPiu) {
            $numero = '+' . $cifre;
        } elseif (str_starts_with($cifre, '00')) {
            $numero = '+' . substr($cifre, 2);
        } elseif (str_starts_with($cifre, '39') && strlen($cifre) >= 11) {
            // "39 370 1234567" scritto senza il +
            $numero = '+' . $cifre;
        } else {
            $numero = '+39' . $cifre;
        }

        return preg_match('/^\+\d{8,15}$/', $numero) ? $numero : null;
    }
}
