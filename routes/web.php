<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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