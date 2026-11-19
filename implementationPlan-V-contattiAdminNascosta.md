# Implementation plan: area admin contatti nascosta

## Obiettivo
Rendere l'area admin dei contatti meno trovabile dai crawler, farla funzionare senza dover configurare niente a mano e permettere di condividere l'accesso con chi raccoglie i numeri insieme a me.

## Modifiche richieste
1. Area admin spostata da `/contatti/admin` a `/aadminn` (fuori dal prefisso `/contatti`).
2. Se la chiave manca o e' sbagliata la pagina mostra un form per inserirla, invece di rispondere 404.
3. Il nome del parametro della chiave non e' piu' `key` ma un nome non intuitivo (`xk7q`), definito in `config/contatti.php`.
4. Se la chiave non e' configurata (`CONTATTI_ADMIN_KEY` vuota) viene generata automaticamente e salvata.
5. Nella pagina admin un pulsante per condividere il link admin, chiave compresa.

## Decisioni
- **Dove si salva la chiave generata**: `storage/app/contatti-admin-key.txt`. Il `.env` e' montato in sola lettura nel container, quindi non si puo' scrivere li'; `./storage` invece e' un volume e sopravvive ai deploy. Se `CONTATTI_ADMIN_KEY` e' impostata ha la precedenza.
- **Come si legge la chiave generata**: nuovo comando `php artisan contatti:chiave` (la crea se non esiste e stampa chiave e URL). Il file e' leggibile anche dal php-fpm se creato da root: la lettura non richiede permessi di scrittura.
- **Form chiave**: `GET /aadminn` senza parametro mostra il form; il form invia in GET `/aadminn?xk7q=<chiave>`, cosi' l'URL risultante e' lo stesso che si condivide. Con chiave sbagliata stesso form con errore (403).
- **vcf e svuota**: con chiave non valida rispondono 404.
- **Condivisione**: pulsante che usa la Web Share API (menu di condivisione del telefono, WhatsApp compreso) e, dove non c'e', copia il link negli appunti. Avviso nella pagina: chi ha il link vede e cancella tutti i contatti.
- Le pagine admin hanno `noindex` e `referrer: no-referrer`, cosi' la chiave nell'URL non finisce nel Referer verso i CDN.

## File
| File | Azione |
|---|---|
| `app/Services/ContattiAdminKey.php` | nuovo (chiave da env o file, verifica con `hash_equals`) |
| `app/Console/Commands/ContattiChiave.php` | nuovo (`contatti:chiave`) |
| `app/Http/Controllers/ContattiController.php` | modificato (form chiave, parametro da config) |
| `config/contatti.php` | modificato (`key_param`, `admin_key` opzionale) |
| `routes/web.php` | gruppo admin spostato su `/aadminn` (nomi rotta invariati) |
| `resources/views/contatti/admin-login.blade.php` | nuovo |
| `resources/views/contatti/admin.blade.php` | modificato (parametro, pulsante condividi) |
| `.env.example`, `README.md`, `TODO.md` | aggiornati |

## Dopo il deploy
1. `php artisan migrate` (se non ancora fatto).
2. `docker compose exec app php artisan contatti:chiave` per leggere la chiave e l'URL.
3. Aprire l'URL dal dominio di produzione, stampare il QR e usare "Condividi pagina admin" per mandare il link agli altri.
