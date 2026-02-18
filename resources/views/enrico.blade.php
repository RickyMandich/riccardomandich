<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Enrico - Trasporto Cose</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', sans-serif;
        }

        .quiz-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            margin-bottom: 20px;
        }

        .option-btn {
            text-align: left;
            margin-bottom: 10px;
            padding: 12px 20px;
            border-radius: 10px;
            border: 1px solid #dee2e6;
            background: white;
            width: 100%;
            transition: all 0.2s;
        }

        .option-btn:hover:not(:disabled) {
            background-color: #e9ecef;
            border-color: #adb5bd;
        }

        .option-btn.correct {
            background-color: #d4edda !important;
            border-color: #c3e6cb !important;
            color: #155724 !important;
        }

        .option-btn.wrong {
            background-color: #f8d7da !important;
            border-color: #f5c6cb !important;
            color: #721c24 !important;
        }

        .sticky-nav {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: white;
            padding: 15px 0;
            border-bottom: 1px solid #dee2e6;
        }
    </style>
</head>

<body>

    <div class="container py-4" x-data="quizHandler()">
        <header class="mb-4 text-center">
            <h1 class="fw-bold">Quiz Trasporto Cose - Enrico</h1>
            <p class="text-muted">Domande ministeriali per l'idoneità professionale</p>
        </header>

        <div class="sticky-nav mb-4 shadow-sm rounded px-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <span class="fw-bold">Pagina {{ $page }} di {{ $totalPages }}</span>
                    <span class="ms-3 text-muted">Domande {{ ($page - 1) * 10 + 1 }} -
                        {{ min($page * 10, $totalQuestions) }}</span>
                </div>
                <nav>
                    <ul class="pagination mb-0">
                        @if($page > 1)
                            <li class="page-item">
                                <a class="page-link" href="?page={{ $page - 1 }}">Precedente</a>
                            </li>
                        @endif

                        <li class="page-item dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle mx-2" type="button"
                                data-bs-toggle="dropdown">
                                Vai a...
                            </button>
                            <ul class="dropdown-menu shadow" style="max-height: 300px; overflow-y: auto;">
                                @for($i = 1; $i <= $totalPages; $i++)
                                    <li><a class="dropdown-item @if($i == $page) active @endif" href="?page={{ $i }}">Gruppo
                                            {{ $i }} ({{ ($i - 1) * 10 + 1 }})</a></li>
                                @endfor
                            </ul>
                        </li>

                        @if($page < $totalPages)
                            <li class="page-item">
                                <a class="page-link" href="?page={{ $page + 1 }}">Successivo</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>

        <div class="row">
            @foreach($questions as $q)
                    <div class="col-12" x-data="{ 
                    selected: null, 
                    answered: false,
                    qId: {{ $q['id'] }},
                    correct: {{ $q['answer'] }}
                }">
                        <div class="card quiz-card p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge bg-secondary">Domanda #{{ $q['id'] }}</span>
                                <small class="text-muted">{{ $q['header'] }}</small>
                            </div>
                            <h5 class="mb-4">{{ $q['question'] }}</h5>

                            <div class="options-container">
                                @foreach($q['options'] as $num => $opt)
                                    <button class="option-btn" :class="{ 
                                        'correct': (answered && {{ $num }} == correct),
                                        'wrong': (answered && selected == {{ $num }} && selected != correct)
                                    }" @click="if(!answered) { selected = {{ $num }}; answered = true; }" :disabled="answered">
                                        <strong>{{ $num }}.</strong> {{ $opt }}
                                    </button>
                                @endforeach
                            </div>

                            <template x-if="answered">
                                <div class="mt-3 p-3 rounded"
                                    :class="selected == correct ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger'">
                                    <div class="d-flex align-items-center">
                                        <span x-show="selected == correct" class="me-2">✅ Risposta corretta!</span>
                                        <span x-show="selected != correct" class="me-2">❌ Errata. La risposta corretta è la
                                            <strong><span x-text="correct"></span></strong>.</span>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
            @endforeach
        </div>

        @if($page < $totalPages)
            <div class="text-center mt-4 mb-5">
                <a href="?page={{ $page + 1 }}" class="btn btn-primary btn-lg px-5 rounded-pill shadow">
                    Vai al prossimo gruppo di 10
                </a>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function quizHandler() {
            return {
                init() {
                    console.log('Quiz loaded');
                }
            }
        }
    </script>
</body>

</html>