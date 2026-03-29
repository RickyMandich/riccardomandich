<?php

use App\Http\Controllers\TombolaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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