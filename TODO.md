- [X] sistemare curriculum autogenerato
- [x] aggiungere foto
# docker compose dev (stesso schema di unlimiteddb)
- [x] `docker-compose.dev.yml`: app + nginx + db, web su `8001`, MariaDB su `3308`, subnet `172.31.0.0/24`, immagine `riccardomandich:dev`
- [x] `docker/mysql/init.dev.sql`: utente `riccardomandich` autorizzato dalla subnet dev
- [x] sezione "Sviluppo locale (Docker)" nel `README.md`
- [x] `Dockerfile`: lo stage Composer ora parte da `php:8.2-fpm-alpine` (con il binario di `composer:2`), perche' `composer:2` e' passata a PHP 8.6 e rompeva il build con il `composer.lock`
- [ ] provare in locale `up -d --build` e `exec app php artisan migrate` (non ancora testato)

# contatti corteo (raccolta numeri via QR code durante la mobilitazione)
- [x] migrazione + modello `Contatto` (tabella `contatti`, telefono normalizzato `+39...` e unico)
- [x] form pubblico `/contatti` (mobile-first, honeypot, throttle, testo privacy)
- [x] area admin su `/aadminn` (parametro chiave `xk7q`, form per inserirla se manca): QR da stampare, lista, export `.vcf`, svuota tutto
- [x] `config/contatti.php` + `CONTATTI_ADMIN_KEY` in `.env.example`
- [x] sezione dedicata nel `README.md`
- [x] chiave admin generata da sola in `storage/app/contatti-admin-key.txt` se `CONTATTI_ADMIN_KEY` e' vuota; comando `php artisan contatti:chiave`
- [x] pulsante "Condividi pagina admin" (link con la chiave)
- [x] QR vuoto in admin e in stampa (`QRCode is not defined`): sostituito `qrcode@1.5.3` (jsDelivr) con `qrcodejs` da cdnjs, canvas sostituito da `<div id="qr">`
- [ ] verificare in locale che il QR compaia e che la stampa lo mostri
- [ ] in produzione: `php artisan migrate`, poi leggere la chiave con `php artisan contatti:chiave` (oppure impostare `CONTATTI_ADMIN_KEY` nel `.env`)
- [ ] dopo la mobilitazione: scaricare il `.vcf` se serve e usare "Svuota tutto"

# enrico (enrico mi ha chiesto di preparargli una pagina dedicata a delle domande)
## indicazioni
- le domande e le risposte sono quelle presenti nei due file pdf nella cartella example/enrico
- la pagina deve essere unica
- le domande non vanno inserite tutte nella stessa pagina ma bisogna gestire una pagination di 10 per volta
    - gestisci la possibilità di accedere a un gruppo di 10 specifico
    - gestisci la possibilità che alla fine di un gruppo si vada direttamente al successivo
- ad ogni risposta bisogna dare un feedback che indica con colore bootstrap success/danger se la risposta è corretta o meno e, in caso di errore, indicare qual'è la risposta corretta (basta il numero della risposta)