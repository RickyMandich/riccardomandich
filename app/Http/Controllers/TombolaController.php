<?php

namespace App\Http\Controllers;

use App\Models\TombolaGame;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TombolaController extends Controller
{
    /**
     * Display page (projector / public view).
     */
    public function display()
    {
        $game = TombolaGame::getOrCreateActive();
        return view('tombola.display', compact('game'));
    }

    /**
     * Admin control panel.
     */
    public function admin()
    {
        $game = TombolaGame::getOrCreateActive();
        return view('tombola.admin', compact('game'));
    }

    /**
     * Polling endpoint: returns current game state as JSON.
     */
    public function state(): JsonResponse
    {
        $game = TombolaGame::getOrCreateActive();

        return response()->json([
            'board_state' => $game->board_state,
            'last_drawn_number' => $game->last_drawn_number,
            'current_objective' => $game->current_objective,
            'drawn_count' => $game->drawn_count,
            'updated_at' => $game->updated_at?->toISOString(),
        ]);
    }

    /**
     * Draw a manually-input number (analogue extraction).
     */
    public function drawNumber(Request $request): JsonResponse
    {
        $request->validate([
            'number' => 'required|integer|min:1|max:90',
        ]);

        $game = TombolaGame::getOrCreateActive();
        $number = (int) $request->number;

        if ($game->isDrawn($number)) {
            return response()->json(['error' => 'Numero già estratto'], 422);
        }

        $game->drawNumber($number);

        return $this->state();
    }

    /**
     * Undo a drawn number.
     */
    public function undoNumber(Request $request): JsonResponse
    {
        $request->validate([
            'number' => 'required|integer|min:1|max:90',
        ]);

        $game = TombolaGame::getOrCreateActive();
        $number = (int) $request->number;

        if (!$game->isDrawn($number)) {
            return response()->json(['error' => 'Numero non ancora estratto'], 422);
        }

        $game->undoNumber($number);

        return $this->state();
    }

    /**
     * Change the current objective (independent from number drawing).
     */
    public function setObjective(Request $request): JsonResponse
    {
        $request->validate([
            'objective' => 'required|in:AMBO,TERNO,QUATERNA,CINQUINA,TOMBOLA,TOMBOLINO',
        ]);

        $game = TombolaGame::getOrCreateActive();
        $game->current_objective = $request->objective;
        $game->save();

        return $this->state();
    }

    /**
     * Create a new game (preserves the old one in DB history).
     */
    public function newGame(): JsonResponse
    {
        TombolaGame::createNewGame();

        return $this->state();
    }
}
