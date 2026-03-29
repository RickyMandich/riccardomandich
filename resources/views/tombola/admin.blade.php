@extends('layouts.app')

@section('title', 'Tombola PRO — Admin')

@section('include')
    @vite(['resources/scss/tombola.scss'])
@endsection

@section('content')
    <div class="tombola-admin-container">
        <h2 class="text-center mb-4"><i class="bi bi-gear-fill"></i> Tombola PRO — Pannello Admin</h2>

        <div class="row g-4">
            {{-- Left: Board --}}
            <div class="col-lg-8">
                <div class="glass-card">
                    <h5 class="section-title"><i class="bi bi-grid-3x3-gap-fill"></i> Tabellone</h5>
                    <table class="table tombola-board tombola-admin-board" id="adminBoard">
                        <tbody>
                            @php $num = 1; @endphp
                            @for ($row = 0; $row < 9; $row++)
                                <tr>
                                    @for ($col = 0; $col < 11; $col++)
                                        @if ($col === 5)
                                            <td class="tombola-gap"></td>
                                        @else
                                            <td class="text-center p-0">
                                                <button class="tombola-cell {{ ($game->board_state[$num] ?? false) ? 'drawn' : '' }}"
                                                    data-numero="{{ $num }}" id="admin-cell-{{ $num }}"
                                                    onclick="toggleNumber({{ $num }})">
                                                    {{ $num }}
                                                </button>
                                            </td>
                                            @php $num++; @endphp
                                        @endif
                                    @endfor
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Right: Controls --}}
            <div class="col-lg-4">
                {{-- Manual input --}}
                <div class="glass-card">
                    <h5 class="section-title"><i class="bi bi-input-cursor-text"></i> Inserimento Manuale</h5>
                    <div class="input-group mb-2">
                        <input type="number" class="form-control form-control-lg" id="manualInput" min="1" max="90"
                            placeholder="1-90" onkeyup="if(event.key === 'Enter') drawManual()">
                        <button class="btn btn-primary btn-lg" onclick="drawManual()">
                            <i class="bi bi-plus-circle"></i> Inserisci
                        </button>
                    </div>
                    <div id="feedbackMessage"></div>
                </div>

                {{-- Objective --}}
                <div class="glass-card">
                    <h5 class="section-title"><i class="bi bi-bullseye"></i> Obiettivo Corrente</h5>
                    <div class="d-flex flex-wrap gap-2" id="objectiveBtns">
                        @foreach (['AMBO', 'TERNO', 'QUATERNA', 'CINQUINA', 'TOMBOLA', 'TOMBOLINO'] as $obj)
                            <button
                                class="btn {{ $game->current_objective === $obj ? 'btn-warning' : 'btn-outline-warning' }} flex-fill"
                                onclick="setObjective('{{ $obj }}')" id="obj-{{ $obj }}">
                                {{ $obj }}
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Stats --}}
                <div class="glass-card">
                    <h5 class="section-title"><i class="bi bi-bar-chart-fill"></i> Statistiche</h5>
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="fs-2 fw-bold text-warning" id="statsDrawn">{{ $game->drawn_count }}</div>
                            <small class="text-muted">Estratti</small>
                        </div>
                        <div class="col-6">
                            <div class="fs-2 fw-bold text-info" id="statsRemaining">{{ 90 - $game->drawn_count }}</div>
                            <small class="text-muted">Rimanenti</small>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 8px;">
                        <div class="progress-bar bg-warning" id="statsProgress"
                            style="width: {{ ($game->drawn_count / 90) * 100 }}%"></div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="glass-card">
                    <h5 class="section-title"><i class="bi bi-tools"></i> Azioni</h5>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-danger" onclick="undoLast()" id="undoBtn" {{ $game->last_drawn_number ? '' : 'disabled' }}>
                            <i class="bi bi-arrow-counterclockwise"></i>
                            Annulla ultimo
                            <span
                                id="undoNumber">{{ $game->last_drawn_number ? '(' . $game->last_drawn_number . ')' : '' }}</span>
                        </button>
                        <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#newGameModal">
                            <i class="bi bi-plus-square"></i> Nuova Partita
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- New Game Confirmation Modal --}}
    <div class="modal fade" id="newGameModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content glass-card border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title section-title mb-0">Nuova Partita</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Vuoi iniziare una nuova partita?</p>
                    <p class="text-muted small">La partita corrente sarà salvata nello storico.</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <button type="button" class="btn btn-success" onclick="newGame()">
                        <i class="bi bi-check-lg"></i> Conferma
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        let currentState = {
            board_state: @json($game->board_state),
            last_drawn_number: @json($game->last_drawn_number),
            current_objective: @json($game->current_objective),
            drawn_count: @json($game->drawn_count),
        };

        async function apiCall(url, data = {}) {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify(data),
            });

            const result = await response.json();

            if (!response.ok) {
                showFeedback(result.error || result.message || 'Errore', 'danger');
                throw new Error(result.error || 'API error');
            }

            currentState = result;
            refreshUI();
            return result;
        }

        function refreshUI() {
            // Update board cells
            for (let i = 1; i <= 90; i++) {
                const cell = document.getElementById('admin-cell-' + i);
                if (cell) {
                    if (currentState.board_state[i] || currentState.board_state[String(i)]) {
                        cell.classList.add('drawn');
                    } else {
                        cell.classList.remove('drawn');
                    }
                }
            }

            // Update stats
            document.getElementById('statsDrawn').textContent = currentState.drawn_count;
            document.getElementById('statsRemaining').textContent = 90 - currentState.drawn_count;
            document.getElementById('statsProgress').style.width =
                (currentState.drawn_count / 90 * 100) + '%';

            // Update objective buttons
            document.querySelectorAll('#objectiveBtns button').forEach(btn => {
                const obj = btn.id.replace('obj-', '');
                btn.className = (obj === currentState.current_objective)
                    ? 'btn btn-warning flex-fill'
                    : 'btn btn-outline-warning flex-fill';
            });

            // Update undo button
            const undoBtn = document.getElementById('undoBtn');
            const undoNumber = document.getElementById('undoNumber');
            if (currentState.last_drawn_number) {
                undoBtn.disabled = false;
                undoNumber.textContent = '(' + currentState.last_drawn_number + ')';
            } else {
                undoBtn.disabled = true;
                undoNumber.textContent = '';
            }
        }

        function showFeedback(message, type = 'success') {
            const el = document.getElementById('feedbackMessage');
            el.innerHTML = `<div class="alert alert-${type} py-1 px-2 mb-0 mt-1 small">${message}</div>`;
            setTimeout(() => { el.innerHTML = ''; }, 3000);
        }

        async function toggleNumber(number) {
            try {
                if (currentState.board_state[number] || currentState.board_state[String(number)]) {
                    await apiCall('{{ route("tombola.undo") }}', { number });
                    showFeedback(`Numero ${number} annullato`, 'warning');
                } else {
                    await apiCall('{{ route("tombola.draw") }}', { number });
                    showFeedback(`Numero ${number} inserito`, 'success');
                }
            } catch (e) {
                // Error already shown by apiCall
            }
        }

        async function drawManual() {
            const input = document.getElementById('manualInput');
            const number = parseInt(input.value);

            if (isNaN(number) || number < 1 || number > 90) {
                showFeedback('Inserisci un numero tra 1 e 90', 'danger');
                return;
            }

            try {
                await apiCall('{{ route("tombola.draw") }}', { number });
                showFeedback(`Numero ${number} inserito`, 'success');
                input.value = '';
                input.focus();
            } catch (e) {
                // Error already shown
            }
        }

        async function setObjective(objective) {
            try {
                await apiCall('{{ route("tombola.objective") }}', { objective });
                showFeedback(`Obiettivo: ${objective}`, 'info');
            } catch (e) { }
        }

        async function undoLast() {
            if (!currentState.last_drawn_number) return;
            try {
                await apiCall('{{ route("tombola.undo") }}', { number: currentState.last_drawn_number });
                showFeedback('Ultima estrazione annullata', 'warning');
            } catch (e) { }
        }

        async function newGame() {
            try {
                await apiCall('{{ route("tombola.new") }}');
                showFeedback('Nuova partita iniziata!', 'success');
                bootstrap.Modal.getInstance(document.getElementById('newGameModal')).hide();
            } catch (e) { }
        }
    </script>
@endsection