# 📝 Analisi Pre-Progetto: Bingo Real-Time (Tombola PRO)
## 1. Obiettivo del Progetto

Realizzare un'applicazione web per la gestione di un tabellone di Tombola (90 numeri) progettata per un uso semi-analogico: estrazione manuale, inserimento dati tramite interfaccia amministratore e visualizzazione live su proiettore per il pubblico.
## 2. Stack Tecnologico

* Framework: Laravel 12.x (PHP 8.2+).
* Reattività Frontend: Livewire 3+ (integrato nei nuovi starter kit di Laravel 12).
* Motore Real-Time: [Laravel Reverb](https://reverb.laravel.com/) (WebSocket server nativo).
* Styling: Bootstrap 5 (per la gestione dei Modal e della griglia responsiva). [1, 6, 7, 8, 9] 

3. Strategia di Ottimizzazione Dati (Bit-Packing)
Per evitare il sovraccarico del database (90 colonne) o la verbosità dei formati JSON, il tabellone verrà salvato come una stringa binaria di 12 byte.

* Meccanismo: Ogni bit dei 12 byte rappresenta lo stato (estratto/non estratto) di un numero.
* Implementazione: Un Custom Eloquent Cast trasformerà automaticamente il binario in un array booleano leggibile da PHP durante l'accesso al modello, e viceversa durante il salvataggio. [10, 11] 

## 4. Flusso di Funzionamento (User Journey)

   1. Inserimento (Admin): L'utente preme un numero sul tastierino digitale.
   * Il backend aggiorna il bit corrispondente nel database.
      * Viene scatenato un evento BallDrawn tramite Laravel Reverb.
   2. Visualizzazione (Display): La pagina del proiettore è in ascolto sul canale WebSocket.
   * Alla ricezione dell'evento, Livewire aggiorna il tabellone senza ricaricare la pagina.
      * Un Modal Bootstrap a tutto schermo viene attivato via JavaScript per mostrare il numero estratto in formato gigante per 4 secondi. [2, 12, 13, 14] 
   
5. Valore per il Curriculum (Technical Highlights)

* Efficienza: Utilizzo di logica bitwise per il risparmio di risorse (storage & I/O).
* Scalabilità: Architettura event-driven con gestione di connessioni persistenti (WebSocket).
* Clean Code: Incapsulamento della logica complessa nei Cast e nei Componenti dedicati.
* UX Focus: Design inclusivo pensato per utenti anziani (alto contrasto, feedback visivo persistente).