@extends('layouts.app')

@section('title', 'Tombola PRO')

@section('include')
    @vite(['resources/scss/tombola.scss'])
@endsection

@section('content')
    <div class="tombola-display-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="tombola-objective m-0" id="objectiveTitle">
                si va per <span id="objectiveText">{{ $game->current_objective }}</span>
            </h1>

            <div class="tombola-stats-bar text-center mt-3">
                <span class="badge bg-warning text-dark fs-6">
                    Estratti: <strong id="drawnCount">{{ $game->drawn_count }}</strong> / 90
                </span>
            </div>

            <button class="btn btn-outline-light btn-sm" onclick="toggleFullscreen()" title="Schermo intero">
                <i class="bi bi-arrows-fullscreen"></i>
            </button>
        </div>

        <table class="table tombola-board tombola-display-board" id="tombolaBoard">
            <tbody>
                @php $num = 1; @endphp
                @for ($row = 0; $row < 9; $row++)
                    <tr>
                        @for ($col = 0; $col < 11; $col++)
                            @if ($col === 5)
                                <td class="tombola-gap"></td>
                            @else
                                <td class="text-center p-0">
                                    <div class="tombola-cell {{ ($game->board_state[$num] ?? false) ? 'drawn' : '' }}"
                                        data-numero="{{ $num }}" id="cell-{{ $num }}">
                                        {{ $num }}
                                    </div>
                                </td>
                                @php $num++; @endphp
                            @endif
                        @endfor
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>

    {{-- Modal popup for giant number --}}
    <div class="modal fade" id="numeroModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content tombola-number-modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="tombola-number-giant" id="numeroGrande"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector("nav").classList.add("d-none");
            const numeroModal = new bootstrap.Modal(document.getElementById('numeroModal'));
            const numeroGrande = document.getElementById('numeroGrande');
            let timeoutId = null;
            let lastUpdatedAt = @json($game->updated_at?->toISOString());
            let lastDrawnNumber = @json($game->last_drawn_number);

            function updateBoard(boardState) {
                for (let i = 1; i <= 90; i++) {
                    const cell = document.getElementById('cell-' + i);
                    if (cell) {
                        if (boardState[i] || boardState[String(i)]) {
                            cell.classList.add('drawn');
                        } else {
                            cell.classList.remove('drawn');
                        }
                    }
                }
            }

            function updateObjective(objective) {
                document.getElementById('objectiveText').textContent = objective;
            }

            function updateStats(drawnCount) {
                document.getElementById('drawnCount').textContent = drawnCount;
            }

            function showNumberModal(number) {
                numeroGrande.textContent = number;
                numeroModal.show();
                if (timeoutId) clearTimeout(timeoutId);
                timeoutId = setTimeout(() => {
                    numeroModal.hide();
                }, 10000);
            }

            // Close modal on click anywhere
            document.getElementById('numeroModal').addEventListener('click', function (e) {
                if (e.target === this || e.target.closest('.modal-body')) {
                    if (timeoutId) clearTimeout(timeoutId);
                    numeroModal.hide();
                }
            });

            document.getElementById('numeroModal').addEventListener('hidden.bs.modal', function () {
                if (timeoutId) clearTimeout(timeoutId);
            });

            // Fullscreen toggle
            window.toggleFullscreen = function () {
                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen();
                } else {
                    document.exitFullscreen();
                }
            };

            // Polling every 500ms
            setInterval(async () => {
                try {
                    const response = await fetch('{{ route("tombola.state") }}');
                    const data = await response.json();

                    if (data.updated_at !== lastUpdatedAt) {
                        lastUpdatedAt = data.updated_at;
                        updateBoard(data.board_state);
                        updateObjective(data.current_objective);
                        updateStats(data.drawn_count);

                        // Show modal only when a NEW number is drawn
                        if (data.last_drawn_number && data.last_drawn_number !== lastDrawnNumber) {
                            showNumberModal(data.last_drawn_number);
                        }
                        lastDrawnNumber = data.last_drawn_number;
                    }
                } catch (e) {
                    console.error('Polling error:', e);
                }
            }, 500);
        });
    </script>
@endsection