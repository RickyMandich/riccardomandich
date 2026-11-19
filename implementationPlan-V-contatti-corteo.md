# Implementation plan: contatti corteo

## Obiettivo
Raccogliere al volo nome e numero di telefono delle persone incontrate durante una mobilitazione, per poi aggiungerle a gruppi WhatsApp. La persona inquadra un QR code stampato, compila un form di due campi e invia. Chi raccoglie vede la lista da una pagina protetta.

Vincoli: nessun nuovo framework, nessun nuovo Docker, tutto dentro questo progetto Laravel 12 (stile `TombolaController`).

## Decisioni
- **Storage**: tabella MySQL `contatti` (`nome`, `telefono`, timestamps). Il telefono e' normalizzato in formato internazionale (`+39...`) e unico: un secondo invio dello stesso numero aggiorna il nome invece di duplicare.
- **Viste standalone** con Bootstrap da CDN (come `enrico.blade.php`): nessuna build Vite necessaria, mobile-first.
- **QR code generato lato client** nella pagina admin (libreria `qrcode` da CDN), con pulsante di stampa. Nessun pacchetto Composer da installare.
- **Export `.vcf`**: un solo file importabile nella rubrica del telefono, comodo per creare i gruppi WhatsApp.
- **Protezione admin**: chiave segreta in `CONTATTI_ADMIN_KEY` (`.env`), passata come `?key=...`. Se la chiave non e' configurata l'area admin risponde 404 (fail closed).

## File
| File | Azione |
|---|---|
| `database/migrations/2026_11_19_220000_create_contatti_table.php` | nuovo |
| `app/Models/Contatto.php` | nuovo (normalizzazione telefono) |
| `app/Http/Controllers/ContattiController.php` | nuovo |
| `config/contatti.php` | nuovo (`admin_key`) |
| `resources/views/contatti/form.blade.php` | nuovo (form pubblico) |
| `resources/views/contatti/grazie.blade.php` | nuovo (conferma) |
| `resources/views/contatti/admin.blade.php` | nuovo (QR, lista, export, svuota) |
| `routes/web.php` | aggiunta gruppo `contatti` |
| `.env.example` | aggiunta `CONTATTI_ADMIN_KEY` |
| `README.md`, `TODO.md` | documentazione e specchio delle modifiche |

## Rotte
- `GET /contatti` form pubblico
- `POST /contatti` salva (throttle 60/min, honeypot, validazione)
- `GET /contatti/grazie` conferma
- `GET /contatti/admin?key=` lista + QR da stampare
- `GET /contatti/admin/contatti.vcf?key=` export rubrica
- `POST /contatti/admin/svuota` cancella tutti i contatti

## Privacy e sicurezza
- Testo chiaro sul form: il numero serve solo per il gruppo e viene cancellato dopo l'iniziativa.
- Honeypot + throttle contro bot e spam; CSRF attivo sul form.
- Admin dietro chiave con throttle; pulsante "Svuota tutto" a fine uso.
- Non toccati `vendor`, `node_modules` e file del framework.

## Dopo il deploy
1. Aggiungere `CONTATTI_ADMIN_KEY=<chiave lunga e casuale>` al `.env` di produzione.
2. Eseguire `php artisan migrate`.
3. Aprire `/contatti/admin?key=...` **dal dominio di produzione** (il QR codifica l'URL da cui si apre la pagina) e stampare il QR.
4. A fine iniziativa: scaricare il `.vcf` se serve, poi "Svuota tutto".
