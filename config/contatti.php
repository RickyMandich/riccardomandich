<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Chiave area admin contatti
    |--------------------------------------------------------------------------
    |
    | Opzionale. Se e' impostata nel .env (CONTATTI_ADMIN_KEY) si usa quella;
    | se e' vuota la chiave viene generata al primo uso e salvata in
    | storage/app/contatti-admin-key.txt (si legge con `php artisan contatti:chiave`).
    | Mai in Git.
    |
    */

    'admin_key' => env('CONTATTI_ADMIN_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Nome del parametro della chiave
    |--------------------------------------------------------------------------
    |
    | L'area admin e' su /aadminn?<key_param>=<chiave>. Il nome e' volutamente
    | poco intuitivo, per non essere indovinato da crawler e curiosi.
    |
    */

    'key_param' => 'xk7q',

];
