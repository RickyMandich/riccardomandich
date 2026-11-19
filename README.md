<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Sviluppo locale (Docker)

Prerequisito: Docker Desktop.

```bash
cp .env.example .env
# APP_KEY: il container monta il .env in sola lettura, quindi key:generate dentro il container
# non puo' scriverlo. Genera la chiave con:
#   docker compose -f docker-compose.dev.yml run --rm app php artisan key:generate --show
# e incollala in APP_KEY=.
docker compose -f docker-compose.dev.yml up -d --build
docker compose -f docker-compose.dev.yml exec app php artisan migrate
```

Il sito risponde su <http://localhost:8001>; l'area admin dei contatti e' su <http://localhost:8001/aadminn> (la chiave si legge con `docker compose -f docker-compose.dev.yml exec app php artisan contatti:chiave`). Servizi del compose di sviluppo: `app` (php-fpm), `nginx` e `db` (MariaDB 11 senza password, database `riccardomandich`, esposto sulla porta `3308` del computer). Tutti con `restart: unless-stopped`. Per fermare tutto: `docker compose -f docker-compose.dev.yml down` (con `-v` si cancella anche il database).

`docker-compose.dev.yml` e' il compose di **sviluppo**; `docker-compose.yml` e' quello di **produzione** (Traefik, rete esterna `proxy`, host `curriculum.mandich.dev`). Lo schema e' lo stesso di `unlimiteddb`; le porte (web `8001`, MariaDB `3308`) e la subnet (`172.31.0.0/24`) sono scelte per non collidere con gli altri progetti, quindi piu' progetti possono girare insieme. Non c'e' il worker: il sito non usa le code.

`public/build` (asset Vite) e' committato in Git e montato sia in `app` sia in `nginx`: dopo una modifica agli asset basta `npm run build` in locale.

## Funzionalita' custom

### Raccolta contatti (`/contatti`)

Pagina pensata per le mobilitazioni: si stampa un QR code, chi lo inquadra lascia nome e numero di telefono, chi raccoglie vede la lista e crea i gruppi WhatsApp.

| Rotta | Cosa fa |
|---|---|
| `GET /contatti` | form pubblico (nome + telefono) |
| `POST /contatti` | salva il contatto (throttle 60/min, honeypot, validazione) |
| `GET /contatti/grazie` | conferma dopo l'invio |
| `GET /aadminn` | senza chiave mostra il form per inserirla; con `?xk7q=<chiave>` lista contatti + QR da stampare + pulsante per condividere il link admin |
| `GET /aadminn/contatti.vcf?xk7q=<chiave>` | export `.vcf` importabile nella rubrica del telefono |
| `POST /aadminn/svuota` | cancella tutti i contatti (la chiave va nel campo `xk7q`) |

Come e' fatta:

- `app/Http/Controllers/ContattiController.php`: logica delle rotte. `/aadminn` mostra il form della chiave se manca o e' sbagliata (403 se sbagliata); `.vcf` e svuota rispondono 404 senza chiave valida.
- `app/Models/Contatto.php`: tabella `contatti`; `normalizzaTelefono()` porta i numeri in formato `+39...` (senza prefisso assume l'Italia). Il telefono e' unico: un secondo invio aggiorna solo il nome.
- `resources/views/contatti/`: `form`, `grazie`, `admin`, `admin-login` (form della chiave). Sono pagine standalone con Bootstrap da CDN, senza build Vite. Il QR e' generato nel browser (libreria `qrcodejs` da cdnjs, variabile globale `QRCode`) dall'URL del form pubblico, quindi la pagina admin ha bisogno di rete per caricare lo script; se il QR e' vuoto controlla la console del browser. Il vecchio `qrcode@1.5.3` da jsDelivr non esponeva `QRCode` ed e' stato sostituito.
- `config/contatti.php`: nome del parametro della chiave (`key_param`, oggi `xk7q`, volutamente poco intuitivo) e `CONTATTI_ADMIN_KEY` opzionale dal `.env`.
- `app/Services/ContattiAdminKey.php`: chiave admin. Se `CONTATTI_ADMIN_KEY` e' vuota viene generata al primo uso e salvata in `storage/app/contatti-admin-key.txt` (`./storage` e' un volume Docker, quindi resta tra un deploy e l'altro). Il comando `php artisan contatti:chiave` stampa chiave e URL (e la crea se manca).

Per metterla in funzione:

1. (Opzionale) impostare `CONTATTI_ADMIN_KEY` nel `.env`: se e' vuota la chiave viene generata da sola.
2. Eseguire `php artisan migrate`.
3. Leggere chiave e URL con `docker compose exec app php artisan contatti:chiave`, aprire l'URL **dal dominio di produzione** e stampare il QR. Il pulsante "Condividi pagina admin" manda il link (chiave compresa) a chi raccoglie i numeri con te.
4. A fine iniziativa scaricare il `.vcf` se serve e usare "Svuota tutto": i numeri raccolti vanno cancellati, come scritto nell'informativa del form.

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
