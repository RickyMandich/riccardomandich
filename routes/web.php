<?php

use App\Http\Controllers\ContattiController;
use App\Http\Controllers\TombolaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Raccolta contatti (QR code durante le mobilitazioni): form pubblico
Route::prefix('contatti')->name('contatti.')->group(function () {
    Route::get('/', [ContattiController::class, 'form'])->name('form');
    Route::post('/', [ContattiController::class, 'store'])->middleware('throttle:60,1')->name('store');
    Route::get('/grazie', [ContattiController::class, 'grazie'])->name('grazie');

    // Area admin dei contatti: percorso volutamente poco intuitivo, accesso con chiave (vedi config/contatti.php)
    Route::prefix('aadminn')->middleware('throttle:30,1')->group(function () {
        Route::get('/', [ContattiController::class, 'admin'])->name('admin');
        Route::get('/contatti.vcf', [ContattiController::class, 'vcf'])->name('vcf');
        Route::post('/svuota', [ContattiController::class, 'svuota'])->name('svuota');
    });
});

// Tombola PRO
Route::prefix('tombola')->group(function () {
    Route::get('/', [TombolaController::class, 'display'])->name('tombola.display');
    Route::get('/admin', [TombolaController::class, 'admin'])->name('tombola.admin');
    Route::get('/state', [TombolaController::class, 'state'])->name('tombola.state');
    Route::post('/draw', [TombolaController::class, 'drawNumber'])->name('tombola.draw');
    Route::post('/undo', [TombolaController::class, 'undoNumber'])->name('tombola.undo');
    Route::post('/objective', [TombolaController::class, 'setObjective'])->name('tombola.objective');
    Route::post('/new', [TombolaController::class, 'newGame'])->name('tombola.new');
});

Route::get('/enrico', function () {
    $allQuestions = require resource_path('data/enrico_quizzes.php');
    $totalQuestions = count($allQuestions);
    $perPage = 10;
    $totalPages = ceil($totalQuestions / $perPage);

    $page = request('page', 1);
    if (!is_numeric($page) || $page < 1)
        $page = 1;
    if ($page > $totalPages && $totalPages > 0)
        $page = $totalPages;

    $questions = array_slice($allQuestions, ($page - 1) * $perPage, $perPage);

    return view('enrico', compact('questions', 'page', 'totalPages', 'totalQuestions'));
});
