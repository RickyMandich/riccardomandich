<?php

$answers = require resource_path('data/enrico_answers.php');

$questionsRaw = <<<'EOD'
1) A 1 cn art 15
L'amministrazione della Marina Mercantile è attualmente retta:
1. dal Ministero della Difesa (Marina)
2. dal Ministero dell'Ambiente
3. dal Ministero dei Trasporti
2) A 1 cn art 15
Quale è il Ministero competente sull'amministrazione della 
navigazione marittima:
1. Ministero dei Lavori Pubblici
2. Ministero della Marina Mercantile
3. Ministero dei Trasporti
3) A 1 cn art 16
Il capo del Compartimento Marittimo di Venezia ricopre anche 
la carica di:
1. Ispettore di Porto di Venezia
2. Comandante del Porto di Venezia
3. Capo della Dogana di Venezia
4) A 1 cn art 16
La Delegazione di Spiaggia dipende:
1. dall'Ente di Promozione Turistica
2. dal Sindaco
3. dall'Ufficio Circondariale Marittimo
5) A 1 cn art 16
L'Ufficio del Compartimento Marittimo è denominato:
1. Direzione Marittima
2. Capitaneria di Porto
3. Ufficio Locale Marittimo
6) A 1 cn art 16
Quali sono le circoscrizioni in cui è suddiviso il litorale per 
l'amministrazione della navigazione marittima?
1. zone, compartimenti, circondari, uffici locali di
porto/delegazioni di spiaggia
2. compartimenti, porti e delegazioni
3. circondari, porti e uffici
7) A 1 cn art 17
Chi esercita le funzioni di capo di zona marittima?
1. il Direttore Marittimo
2. il Capitano del Porto
3. il Comandante del Circondario
8) A 1 cn art 18
Le funzioni amministrative attinenti alla navigazione e al 
traffico marittimo sono esercitate:
1. dal Corpo delle Capitanerie di Porto
2. da Enti Portuali appositamente costituiti in ciascun porto 
della Repubblica Italiana
3. dal Corpo delle Guardie di Finanza - ramo mare
9) A 1 cn art 18
Quale ufficio esercita le funzioni amministrative attinenti alla 
navigazione marittima?
1. Capitaneria di Porto
2. Ispettorato di Porto
3. Dipartimento dei Trasporti Terrestri
10) A 1 cn art 21
Quale è il Ministero competente sull'amministrazione della 
navigazione interna?
1. Ministero dei Lavori Pubblici
2. Ministero della Marina Mercantile
3. Ministero dei Trasporti
11) A 1 cn art 21
Quali sono le autorità competenti sull'amministrazione della 
navigazione interna?
1. Stato e Regioni
2. Stato e Comuni
3. Regioni e Comuni
12) A 1 cn art 23
Quali sono le circoscrizioni in cui è suddiviso il territory per 
l'amministrazione della navigazione interna da parte delle 
Regioni?
1. Capitanerie di Porto
2. Ispettorati di Porto
3. Delegazioni di Spiaggia
13) A 1 cn art 24
Che denominazione ha la navigazione in acque interne, 
appositamente delimitate, svolta con navi addette alla 
navigazione marittima?
1. navigazione promiscua
2. navigazione locale
3. navigazione litoranea
14) A 1 cn art 24
Che denominazione ha la navigazione in acque marittime, 
appositamente delimitate, svolta con navi addette alla 
navigazione interna?
1. navigazione promiscua
2. navigazione locale
3. navigazione litoranea
15) A 1 cn art 24
Quali norme deve osservare la nave addetta alla navigazione 
in acque interne quando entra in acque marittime, non 
appositamente delimitate?
1. quelle per la navigazione marittima e con l'autorizzazione 
specifica dell'autorità competente
2. quelle per la navigazione interna
3. sia quelle per la navigazione marittima sia quelle per la 
navigazione interna
16) A 1 cn art 24
Quali norme deve osservare la nave addetta alla navigazione 
in acque marittime quando entra in acque interne, non 
appositamente delimitate?
1. quelle per la navigazione marittima
2. quelle per la navigazione interna e con l'autorizzazione 
specifica dell'autorità competente
3. sia quelle per la navigazione marittima, sia quelle per la 
navigazione interna
17) A 1 cn art 26
Chi esercita la vigilanza su navi e galleggianti addetti al 
servizio urbano che entrano nelle acque marittime, nei porti 
comunicanti con canali ed altre acque interne?
1. il Comandante del Porto
2. il capo dell'Ispettorato di Porto
3. il Sindaco
18) A 1 cn art 28
Quali di questi beni fanno parte del demanio marittimo?
1. i fiumi che sboccano in mare
2. i canali in comunicazione con il mare, almeno una volta 
l'anno
3. le lagune
19) A 1 cn art 129
Come si suddivide il personale addetto alla navigazione 
interna?
1. personale navigante e personale addetto al servizio dei porti
2. personale navigante suddiviso in categorie
3. personale di comando e di bassa forza
20) A 1 cn art 130
Come si suddivide il personale navigante addetto alla 
navigazione interna iscritto alla prima categoria?
1. addetti ai servizi di coperta, di macchina e ai servizi tecnici 
di bordo
2. addetti al traffico ed alla pesca
3. comandanti e macchinisti
21) A 1 cn art 130
Quale personale addetto alla navigazione interna viene iscritto 
alla terza categoria?
1. quello addetto alla piccola navigazione
2. gli addetti al traffico locale od alla pesca costiera
3. il personale di macchina
22) A 1 cn art 130
Quante sono le categorie del personale navigante addetto alla 
navigazione interna?
1. due
2. tre
3. quattro
23) A 1 cn art 131
A quale distinzione del personale addetto alla navigazione 
interna appartengono i barcaioli?
1. personale navigante
2. addetti al servizio dei porti
3. addetti al traffico locale
24) A 1 cn art 132
Dove viene iscritto il personale navigante addetto alla 
navigazione interna?
1. in apposite matricole
2. in appositi registri
3. in appositi ruoli
25) A 1 cn art 134
Quali sono i titoli professionali della navigazione interna ai 
quali deve essere aggiunta la qualifica di "autorizzato" per 
poter svogere determinati servizi?
1. tutti i titoli di coperta
2. tutti i titoli di coperta che consentono il trasporto di persone 
con navi a motore e tutti i titoli di macchina
3. solo i titoli di macchina
26) A 1 cn art 136
Per il Codice della Navigazione, cosa si intende per nave 
minore?
1. una nave costiera, o addetta al servizio dei porti o alla 
navigazione interna
2. una nave di lunghezza inferiore a 24 metri
3. una nave di stazza lorda inferiore a 25 tonnellate
27) A 1 cn art 136
Per il Codice della Navigazione, cosa si intende per nave?
1. una costruzione destinata al trasporto per acqua
2. una costruzione destinata al trasporto per acqua dotata di 
motore
3. un'unità da trasporto di cose o persone di stazza lorda 
superiore a tre tonnellate
28) A 1 cn art 137
Quale ufficio esegue di norma la stazzatura delle navi minori 
della navigazione interna con obbligo di classificazione?
1. Uno degli organismi riconosciuti (RINA s.p.a., Bureau 
Veritas, ecc.)
2. gli Uffici Periferici del Dipartimento dei Trasporti Terrestri
3. l'Ispettorato di Porto
29) A 1 cn art 137
Quale ufficio esegue di norma la stazzatura delle navi minori 
della navigazione interna senza obbligo di classificazione?
1. solo il Registro Navale Italiano
2. l'ufficio periferico del Dipartimento dei Trasporti Terrestri o 
uno degli organismi riconosciuti (RINA s.p.a., Bureau 
Veritas, ecc.)
3. l'Ispettorato di Porto
30) A 1 cn art 138
Alla stazzatura delle navi provvede:
1. l'autorità marittima
2. Uno degli organismi riconosciuti (RINA s.p.a., Bureau 
Veritas, ecc.)
3. il personale tecnico delle costruzioni navali
31) A 1 cn art 141
Cosa contraddistingue le navi addette alla navigazione interna?
1. il nome ed il numero di iscrizione
2. il numero di iscrizione
3. la sigla dell'Ufficio di iscrizione
32) A 1 cn art 141
Cosa contraddistingue le navi minori della navigazione 
marittima di stazza lorda inferiore a dieci tonnellate?
1. il nome ed il numero di iscrizione
2. il numero di iscrizione
3. la sigla dell'Ufficio di iscrizione
33) A 1 cn art 147
Cosa deve fare il proprietario di una nave minore che intende 
iscriverla in un ufficio nel cui territorio di competenza egli non 
ha residenza?
1. deve designare un rappresentante con residenza nel 
territorio
2. non occorre fare nulla
3. non può iscriverla in nessun caso
34) A 1 cn art 153
Quale Ufficio rilascia la licenza delle navi minori?
1. quello presso cui la nave è iscritta
2. il Dipartimento dei Trasporti Terrestri
3. il Pubblico Registro Automobilistico
35) A 1 cn art 154
In quali casi va rinnovata la licenza delle navi minori?
1. alla scadenza annuale
2. quando cambia il proprietario
3. quando la nave va in demolizione
36) A 1 cn art 160
Come si procede per la demolizione volontaria delle navi 
minori a motore di stazza lorda superiore alle dieci tonnellate?
1. non occorre alcuna dichiarazione
2. serve la dichiarazione di volontà all'ufficio di iscrizione e la 
sua autorizzazione
3. basta dichiarare l'avvenuta demolizione
37) A 1 cn art 163
In quali di questi casi si ottiene la cancellazione di una nave 
minore dai registri tenuti presso l'ufficio di iscrizione?
1. con la demolizione
2. non si può cancellare
3. cambiando nome
38) A 1 cn art 165
Chi può richiedere ispezioni e visite straordinarie per la verifica 
delle condizioni di navigabilità della nave?
1. i passeggeri
2. l'equipaggio, nella misura di almeno un terzo
3. l'Ufficio dei Vigili Urbani
39) A 1 cn art 165
Di chi sono poste normalmente a carico le spese per le 
ispezioni e le visite ordinarie e straordinarie per la verifica delle 
condizioni di navigabilità della nave?
1. del richiedente
2. dell'armatore
3. del proprietario
40) A 1 cn art 166
Quale autorità provvede alle visite e ispezioni per
l'accertamento e il controllo delle condizioni di navigabilità 
delle navi addette alla navigazione interna?
1. Solo il Registro Navale Italiano
2. l'ufficio periferico del Dipartimento dei Trasporti Terrestri o 
uno degli organismi riconosciuti (RINA s.p.a., Bureau 
Veritas, ecc.)
3. l'Ispettorato di Porto
41) A 1 cn art 167
Quale autorità provvede alla classificazione delle navi minori?
1. uno degli organismi riconosciuti (RINA s.p.a., Bureau 
Veritas, ecc.)
2. l'ufficio periferico del Dipartimento dei Trasporti Terrestri
3. l'Ispettorato di Porto
42) A 1 cn art 169
Le carte di bordo per le navi minori e i galleggianti sono:
1. rispettivamente il certificato di stazza e il certificato di 
navigabilità
2. le carte nautiche
3. la licenza di navigazione
43) A 1 cn art 169
Quale documento costituisce la carta di bordo per le navi 
minori?
1. la licenza di navigazione
2. il certificato di stazza
3. il certificato di classe o di navigabilità
44) A 1 cn art 225
Quale atto amministrativo è necessario per l'esercizio di servizi 
pubblici di linea per trasporto di persone o di cose, nella 
navigazione interna?
1. concessione - ora atto di affidamento o di autorizzazione al 
servizio di linea per norma regionale
2. autorizzazione al servizio non di linea
3. licenza
45) A 1 cn art 226
Quale atto amministrativo è necessario per l'esercizio di servizi 
pubblici non di linea di trasporto di persone o di cose, nella 
navigazione interna?
1. concessione
2. autorizzazione
3. licenza
46) A 1 cn art 232
Presso quali dei seguenti tipi di cantieri o stabilimenti può 
essere costruita una nave destinata alla navigazione interna?
1. tutti i cantieri
2. quelli iscritti negli elenchi tenuti dall'Ispettorato di Porto
3. quelli iscritti negli elenchi tenuti dall'ufficio periferico del 
Dipartimento dei Trasporti Terrestri
47) A 1 cn art 233
Cosa deve fare chi imprende la costruzione di una nave?
1. deve farne preventivamente dichiarazione all'ufficio 
competente del luogo ove ciò avviene
2. non deve fare nulla
3. deve richiedere il numero di identificazione all'ufficio presso 
cui intende iscriverla
48) A 1 cn art 242
La pubblicità degli atti traslativi della proprietà su navi deve 
essere richiesta:
1. alla Prefettura di Venezia per il loro inserimento nel Foglio 
Annunzi Legali
2. al Comune per la loro affissione all'albo
3. all'Ufficio di iscrizione della nave
49) A 1 cn art 252
Come si trascrive la vendita di una nave minore di stazza 
inferiore alle dieci tonnellate?
1. con dichiarazione scritta del venditore, con firma autenticata
2. con dichiarazione verbale
3. con dichiarazione scritta del compratore, con firma 
autenticata
50) A 1 cn art 265
Come viene chiamato chi assume l'esercizio di una nave?
1. esercente
2. armatore
3. proprietario
51) A 1 cn art 265
L'armatore di una nave è:
1. il proprietario della nave
2. chi assume l'esercizio di una nave
3. il conducente della nave
52) A 1 cn art 267
Cosa deve fare chi intenda assumere l'esercizio di una nave 
iscritta presso un ufficio nel cui territory di competenza egli 
non risieda?
1. deve nominare un rappresentante dell'armatore, ivi 
residente
2. deve nominare un rappresentante del proprietario, ivi 
residente
3. può assumerlo direttamente
53) A 1 cn art 272
In mancanza della dichiarazione di armatore debitamente resa 
pubblica, armatore si presume:
1. chi di fatto gestisce la nave
2. il proprietario o i proprietari
3. che detiene la nave
54) A 1 cn art 272
Se non viene presentata la prevista dichiarazione di armatore, 
chi viene ritenuto tale?
1. il proprietario
2. il comandante
3. che si dichiara verbalmente tale
55) A 1 cn art 273
Chi nomina il comandante della nave?
1. l'armatore
2. il proprietario
3. l'armatore con il consenso del proprietario, se diversi
56) A 1 cn art 273
Il comandante della nave è nominato:
1. dal proprietario o dal gerente in caso di comproprietà della 
nave
2. dall'armatore
3. dall'autorità marittima avuto riguardo ai turni di 
collocamento della gente di mare
57) A 1 cn art 274
Chi risponde dei fatti dell'equipaggio per quanto riguarda la 
nave e la spedizione?
1. l'armatore
2. il proprietario
3. l'armatore assieme al proprietario, se diversi
58) A 1 cn art 292
Chi può assumere il comando di una nave?
1. l'armatore
2. il proprietario
3. solo chi ha i titoli professionali o le abilitazioni prescritte
59) A 1 cn art 297
Chi ha il dovere di accertare di persona che la nave sia idonea 
al viaggio che intraprende?
1. il raccomandatario marittimo
2. il proprietario
3. il comandante
60) A 1 cn art 298
Il comandante della nave deve dirigere personalmente la 
manovra della nave:
1. all'entrata e all'uscita dei porti, dei canali, dei fiumi e 
ogniqualvolta si presentino difficoltà
2. quando la condotta della navigazione richieda particolare 
attenzione e non vi sia a bordo un pilota
3. quando la navigazione si svolge regolarmente
61) A 1 cn art 299
Chi deve accertarsi della presenza a bordo della nave dei 
documenti presenti durante il viaggio?
1. l'armatore
2. il proprietario
3. il comandante
62) A 1 cn art 316
Da chi è costituito l'equipaggio di una nave della navigazione 
interna?
1. da tutti i dipendenti dell'armatore imbarcati
2. dal comandante, dagli ufficiali e dagli iscritti al personale 
navigante imbarcati per servizio
3. dal personale di coperta
63) A 1 cn art 317
Chi stabilisce le norme relative alla composizione e alla forza 
minima dell'equipaggio per le navi addette alla navigazione 
interna?
1. il Comandante del Porto
2. il Ministro dei Trasporti
3. il Ministro della Marina Mercantile
64) A 1 cn art 328
Il contratto di arruolamento:
1. deve essere fatto sempre per atto pubblico ricevuto, in 
Italia, dall'autorità marittima
2. può essere fatto anche verbalmente, ma solo in caso di 
navi minori di stazza lorda non superiore a 5 tsl
3. deve essere comunque stipulato davanti a un notaio sotto 
forma di atto pubblico
65) A 1 cn art 376
Come si chiama il contratto con cui il proprietario o l'armatore 
della nave si obbliga a farla utilizzare da altri per un tempo 
determinato, dietro compenso?
1. noleggio
2. locazione
3. affitto
66) A 1 cn art 376
Nel contratto di locazione di nave una delle parti si obbliga a 
far godere all'altra la nave verso un determinato corrispettivo:
1. per un tempo indeterminato
2. per uno o più viaggi
3. per un determinato tempo
67) A 1 cn art 377
Come si può stipulare un contratto di locazione di una nave in 
generale?
1. verbalmente
2. per iscritto
3. in entrambi i modi
68) A 1 cn art 377
E' obbligatorio stipulare per iscritto un contratto di locazione di 
una nave minore di stazza lorda inferiore a dieci tonnellate?
1. no
2. sì
3. solo se interviene in tal senso accordo tra le parti
69) A 1 cn art 377
E' obbligatorio stipulare per iscritto un contratto di locazione di 
una nave minore di stazza lorda superiore a dieci tonnellate?
1. no
2. sì
3. solo nei casi previsti da regolamenti locali
70) A 1 cn art 378
Come va provata la sublocazione di una nave minore o la 
cessione del contratto di locazione?
1. per iscritto
2. verbalmente
3. come previsto per il contratto di locazione
71) A 1 cn art 378
E' consentita la sublocazione di una nave minore o la cessione 
del contratto di locazione?
1. no
2. sì
3. solo se vi acconsente il locatore
72) A 1 cn art 378
La sublocazione di una nave non può avvenire:
1. in caso di stazza lorda inferiore a 10 tonnellate a 
propulsione meccanica, a 25 negli altri casi
2. se non vi è il consenso del locatore
3. se non vi è stato di necessità comprovata nelle forme 
previste dal Codice e leggi speciali
73) A 1 cn art 380
In un contratto di locazione di una nave, chi è responsabile dei 
danni derivanti da difetti di navigabilità della nave?
1. il locatore - colui che dà in locazione
2. il conduttore - colui che prende in locazione
3. il locatore, a meno di difetti non accertabili con la normale 
diligenza
74) A 1 cn art 381
In un contratto di locazione di una nave, chi è responsabile 
dell'uso corretto della nave in base alle sue caratteristiche 
tecniche ed al tipo di impiego convenuto?
1. il locatore - colui che dà in locazione
2. il conduttore - colui che prende in locazione
3. entrambi
75) A 1 cn art 382
In un contratto di locazione di una nave, se il conduttore non la 
riconsegna nel termine previsto, il contratto si intende 
tacitamente prorogato?
1. sì
2. no
3. solo col consenso del locatore
76) A 1 cn art 383
Entro quanto tempo si prescrivono i diritti derivanti da un 
contratto di locazione di una nave, dalla data di scadenza o di 
riconsegna?
1. sei mesi
2. un anno
3. due anni
77) A 1 cn art 384
Come si chiama il contratto in base al quale l'armatore si 
obbliga, dietro pagamento, a svolgere con una nave 
predeterminata i viaggi prestabiliti da un terzo entro un tempo 
convenuto?
1. locazione
2. noleggio
3. affitto
78) A 1 cn art 384
Come si chiama il contratto in base al quale l'armatore si 
obbliga, dietro pagamento, a svolgere con una nave 
predeterminata uno o più viaggi prestabiliti da un terzo?
1. locazione
2. noleggio
3. affitto
79) A 1 cn art 384
Nel contratto di noleggio l'armatore si obbliga:
1. a compiere con una nave determinata uno o più viaggi 
prestabiliti
2. a trasportare le persone e le merci pattuite
3. a compiere i viaggi ordinati dal locatore alle condizioni 
stabilite dal contratto
80) A 1 cn art 384
Quali sono i tipi di contratto di noleggio?
1. a nave singola o a flotta
2. a viaggio o a tempo
3. scritti o verbali
81) A 1 cn art 385
Cosa deve contenere il contratto scritto di noleggio di una 
nave?
1. l'ammontare del nolo e la durata del contratto, o i viaggi da 
compiere
2. gli estremi della polizza assicurativa
3. gli estremi del versamento della tassa di circolazione
82) A 1 cn art 385
In quali forme devono essere provati i contratti di noleggio di 
una nave minore a motore, di stazza lorda inferiore alla dieci 
tonnellate?
1. per iscritto
2. verbalmente
3. in entrambi i modi
83) A 1 cn art 385
In quali forme devono essere provati i contratti di noleggio di 
una nave minore a motore, di stazza lorda superiore alla dieci 
tonnellate?
1. per iscritto
2. verbalmente
3. in entrambi i modi
84) A 1 cn art 385
In quali forme devono essere provati i contratti di noleggio di 
una nave?
1. per iscritto, ad esclusione di nave minore di stazza inferiore 
a 10 tonnellate a motore
2. verbalmente
3. in entrambi i modi
85) A 1 cn art 386
In un contratto di noleggio di una nave, chi deve provvedere 
all'arruolamento dell'equipaggio?
1. chi prende a noleggio
2. chi dà a noleggio
3. entrambi
86) A 1 cn art 386
In un contratto di noleggio di una nave, chi è responsabile di 
danni dovuti a difetti di navigabilità della nave?
1. chi prende a noleggio
2. chi dà a noleggio
3. chi dà a noleggio, sempre che non si tratti di difetti non 
rilevabili con la normale diligenza
87) A 1 cn art 386
Tra gli obblighi del noleggiante ricorrono quelli di:
1. consegnare la nave con le relative pertinenze in stato di 
navigabilità e con i documenti necessari
2. mettere la nave in stato di navigabilità, armata,
equipaggiata e fornita dei documenti necessari
3. accertarsi che la nave sia convenientemente armata e atta 
a compierte il trasporto
88) A 1 cn art 387
In un contratto di noleggio di una nave a tempo, di chi sono a 
carico le spese per il carburante, i lubrificanti, ed in generale 
quelle relative all'esercizio commerciale della nave?
1. di chi prende a noleggio
2. di chi dà a noleggio
3. di entrambi
89) A 1 cn art 387
Le provviste di combustibile, acqua e lubrificanti necessarie 
per il funzionamento dell'apparato motore e degli impianti 
ausiliari di bordo, nel contratto di noleggio a tempo sono a 
carico
1. dell'armatore
2. del noleggiatore
3. del vettore
90) A 1 cn art 388
In un contratto di noleggio di una nave a tempo, colui che dà a 
noleggio è sempre obbligato ad effettuare i viaggi ordinati da 
colui che prende a noleggio la nave?
1. sì, sempre
2. no, mai
3. si, se non c'è rischio di pericolo per la nave o per le persone
91) A 1 cn art 390
Quale è la forma prevista per il pagamento del nolo in un 
contratto di noleggio di una nave a tempo?
1. rate mensili posticipate
2. rate bimestrali posticipate
3. rate mensili anticipate, in mancanza di patti o usi diversi
92) A 1 cn art 391
In quale caso non è dovuto il pagamento del nolo in un 
contratto di noleggio di una nave a tempo?
1. per mancato uso della nave, per causa imputabile alla 
volontà di chi prende a noleggio
2. per mancato uso della nave, per causa non imputabile alla 
volontà di chi prende a noleggio
3. quando il noleggiatore ritiene di non avere più necessità 
della nave
93) A 1 cn art 393
Chi risponde dell'operato del comandante e dell'equipaggio 
della nave noleggiata per quanto riguarda l'uso commerciale 
della stessa?
1. chi prende a noleggio
2. chi dà a noleggio
3. l'armatore
94) A 1 cn art 394
E' possibile stipulare un contratto di subnoleggio o cedere il 
contratto di noleggio di una nave?
1. sì
2. no
3. solo con l'accordo tra chi dà a noleggio e chi prende a 
noleggio
95) A 1 cn art 394
In caso di subnoleggio o di cessione di contratto di noleggio di 
una nave, chi risponde al noleggiante di quanto previsto dal 
contratto di noleggio originale?
1. il subnoleggiatore o subentrante
2. il noleggiatore
3. sia il noleggiatore che il subnoleggiatore o subentrante
96) A 1 cn art 395
Entro quanto tempo si prescrivono gli obblighi derivanti da un 
contratto di noleggio di una nave, dalla data di scadenza o di 
fine del viaggio?
1. sei mesi
2. un anno
3. due anni
97) A 1 cn art 396
Come si chiama il contratto in base al quale l'armatore si 
obbliga a trasferire persone o cose da un luogo all'altro, 
indicato dall'altro contraente?
1. locazione
2. noleggio
3. trasporto
98) A 1 cn art 396
Il contratto di trasporto deve essere provato per iscritto a meno 
che si tratti di:
1. navi minori di stazza lorda non superiore alle 25 tsl se a 
vela, a 10 tsl se a propulsione meccanica
2. navi adibite al trasporto passeggeri
3. navi di uso locale
99) A 1 cn art 396
La figura del vettore è propria del contratto di:
1. armatorietà
2. costruzione
3. trasporto
100) A 1 cn art 396
Nel contratto di trasporto di cose in generale i soggetti si 
identificano:
1. nel vettore e nel caricatore
2. nel mediatore e nel ricevitore
3. nel raccomandatario e nell'institore
EOD;

// Format: 1) HEADER\nQUESTION\n1. OPT1\n2. OPT2\n3. OPT3
// The regex needs to handle nested newlines in question/options
$questions = [];
$blocks = preg_split('/\n(?=\d+\))/', $questionsRaw);

foreach ($blocks as $block) {
    if (preg_match('/(\d+)\)\s+(.*?)\n(.*?)\n1\.\s+(.*?)\n2\.\s+(.*?)\n3\.\s+(.*)/s', $block, $match)) {
        $id = (int) $match[1];
        $questions[] = [
            'id' => $id,
            'header' => trim($match[2]),
            'question' => trim($match[3]),
            'options' => [
                1 => trim($match[4]),
                2 => trim($match[5]),
                3 => trim($match[6]),
            ],
            'answer' => $answers[$id] ?? null
        ];
    }
}

return $questions;
