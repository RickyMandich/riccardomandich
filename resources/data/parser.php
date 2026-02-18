<?php

/**
 * SCRIPT DI PARSING AUTOMATICO PER I QUIZ DI ENRICO
 * 
 * Istruzioni:
 * 1. Apri il PDF delle DOMANDE, seleziona tutto il testo (Ctrl+A), copialo e incollalo
 *    nel file: resources/data/raw_questions.txt
 * 2. Apri il PDF delle RISPOSTE, seleziona tutto il testo (Ctrl+A), copialo e incollalo
 *    nel file: resources/data/raw_answers.txt
 * 3. Esegui questo script da terminale: php resources/data/parser.php
 */

echo "Avvio parsing...\n";

$questionsFile = __DIR__ . '/raw_questions.txt';
$answersFile = __DIR__ . '/raw_answers.txt';
$outputFile = __DIR__ . '/enrico_quizzes.php';

if (!file_exists($questionsFile) || !file_exists($answersFile)) {
    die("ERRORE: Assicurati che raw_questions.txt e raw_answers.txt esistano in " . __DIR__ . "\n");
}

$rawQuestions = file_get_contents($questionsFile);
$rawAnswers = file_get_contents($answersFile);

// --- 1. PULIZIA GLOBALE ---
// Rimuoviamo intestazioni e piè di pagina del PDF che si ripetono in ogni pagina
$artifacts = [
    '/Città metropolitana di Venezia - Area Trasporti e Logistica/i',
    '/Provincia VE; Sezione: Trasporto Cose/i',
    '/TABELLA CODICI RISPOSTE ESATTE/i',
    '/\(N= numero progressivo domanda; N= numero risposta esatta\)/i',
    '/Pagina \d+ di \d+/i'
];
$rawQuestions = preg_replace($artifacts, '', $rawQuestions);
$rawQuestions = str_replace("\r\n", "\n", $rawQuestions);

// --- 2. PARSING RISPOSTE ---
$answersMap = [];
preg_match_all('/(\d+)\s+([1-3])/', $rawAnswers, $matches, PREG_SET_ORDER);
foreach ($matches as $match) {
    $answersMap[(int) $match[1]] = (int) $match[2];
}
echo "Trovate " . count($answersMap) . " risposte nel file.\n";

// --- 3. PARSING DOMANDE ---
$parsedQuestions = [];
// Pattern: Numero) Header\n Domanda\n 1. Opz1\n 2. Opz2\n 3. Opz3
preg_match_all('/(?<=\n|^)\s*(\d+)\)\s+(.*?)\n(.*?)\n\s*1\.\s+(.*?)\n\s*2\.\s+(.*?)\n\s*3\.\s+(.*?)(?=\n\s*\d+\)|$)/s', "\n" . $rawQuestions, $matches, PREG_SET_ORDER);

foreach ($matches as $match) {
    $id = (int) $match[1];
    $parsedQuestions[$id] = [
        'id' => $id,
        'header' => trim($match[2]),
        'question' => trim($match[3]),
        'options' => [
            1 => trim($match[4]),
            2 => trim($match[5]),
            3 => trim($match[6]),
        ],
        'answer' => $answersMap[$id] ?? null
    ];
}

ksort($parsedQuestions);
$finalQuestions = array_values($parsedQuestions);

// --- 4. OUTPUT ---
$phpContent = "<?php\n\nreturn " . var_export($finalQuestions, true) . ";\n";
file_put_contents($outputFile, $phpContent);

echo "Parsing completato! Generate " . count($finalQuestions) . " domande.\n";
if (count($finalQuestions) < 871) {
    echo "ATTENZIONE: Ne mancano ancora " . (871 - count($finalQuestions)) . ". Assicurati di aver incollato TUTTO il testo del PDF in raw_questions.txt\n";
}
