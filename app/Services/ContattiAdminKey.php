<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Chiave di accesso all'area admin dei contatti (/aadminn).
 *
 * Se CONTATTI_ADMIN_KEY e' impostata nel .env si usa quella; altrimenti la chiave viene generata al primo
 * uso e salvata in storage/app/contatti-admin-key.txt. In Docker ./storage e' un volume, quindi la chiave
 * sopravvive ai deploy (il .env invece e' montato in sola lettura e non si puo' scrivere).
 */
class ContattiAdminKey
{
    /**
     * Ritorna la chiave valida, generandola se non esiste.
     * Ritorna una stringa vuota se non si riesce ne' a leggerla ne' a crearla (in quel caso nessun accesso).
     */
    public static function get(): string
    {
        $daEnv = (string) config('contatti.admin_key');

        if ($daEnv !== '') {
            return $daEnv;
        }

        $path = self::path();

        // Lettura semplice: non richiede permessi di scrittura (il file puo' essere stato creato da root
        // con `php artisan contatti:chiave` e letto poi da php-fpm).
        $key = self::leggi($path);

        if ($key !== '') {
            return $key;
        }

        $file = @fopen($path, 'c+');

        if ($file === false) {
            Log::error('Contatti: impossibile creare la chiave admin in ' . $path);

            return '';
        }

        try {
            flock($file, LOCK_EX);

            // Riletta sotto lock: un'altra richiesta potrebbe averla appena scritta.
            $key = trim((string) stream_get_contents($file));

            if ($key === '') {
                $key = Str::random(40);
                ftruncate($file, 0);
                rewind($file);
                fwrite($file, $key . PHP_EOL);
                fflush($file);
            }

            flock($file, LOCK_UN);
        } finally {
            fclose($file);
        }

        return $key;
    }

    /**
     * True se la chiave fornita coincide con quella valida.
     */
    public static function verifica(mixed $fornita): bool
    {
        if (!is_string($fornita) || $fornita === '') {
            return false;
        }

        $attesa = self::get();

        return $attesa !== '' && hash_equals($attesa, $fornita);
    }

    public static function path(): string
    {
        return storage_path('app/contatti-admin-key.txt');
    }

    private static function leggi(string $path): string
    {
        return is_file($path) ? trim((string) @file_get_contents($path)) : '';
    }
}
