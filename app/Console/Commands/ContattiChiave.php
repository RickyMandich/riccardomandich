<?php

namespace App\Console\Commands;

use App\Services\ContattiAdminKey;
use Illuminate\Console\Command;

class ContattiChiave extends Command
{
    protected $signature = 'contatti:chiave';

    protected $description = "Mostra la chiave e l'URL dell'area admin dei contatti (la genera se non esiste ancora)";

    public function handle(): int
    {
        $key = ContattiAdminKey::get();

        if ($key === '') {
            $this->error("Impossibile leggere o creare la chiave: storage/app non e' scrivibile.");

            return self::FAILURE;
        }

        $this->line('Chiave: ' . $key);
        $this->line('URL:    ' . url('/aadminn') . '?' . config('contatti.key_param') . '=' . $key);
        $this->line("(l'host dell'URL dipende da APP_URL)");

        return self::SUCCESS;
    }
}
