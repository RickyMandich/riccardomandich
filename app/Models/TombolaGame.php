<?php

namespace App\Models;

use App\Casts\BoardStateCast;
use Illuminate\Database\Eloquent\Model;

/**
 * @property array<int, bool> $board_state
 * @property int|null $last_drawn_number
 * @property string $current_objective
 * @property bool $is_active
 * @property int $drawn_count
 */
class TombolaGame extends Model
{
    protected $fillable = [
        'board_state',
        'last_drawn_number',
        'current_objective',
        'is_active',
        'drawn_count',
    ];

    protected $casts = [
        'board_state' => BoardStateCast::class,
        'is_active' => 'boolean',
    ];

    /**
     * Scope: only active games
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the current active game, or create one if none exists.
     */
    public static function getOrCreateActive(): self
    {
        $game = static::active()->first();

        if (!$game) {
            $game = new static();
            $game->board_state = array_fill_keys(range(1, 90), false);
            $game->current_objective = 'AMBO';
            $game->is_active = true;
            $game->drawn_count = 0;
            $game->save();
        }

        return $game;
    }

    /**
     * Create a new game, deactivating the current one (preserving history).
     */
    public static function createNewGame(): self
    {
        static::where('is_active', true)->update(['is_active' => false]);

        $game = new static();
        $game->board_state = array_fill_keys(range(1, 90), false);
        $game->current_objective = 'AMBO';
        $game->is_active = true;
        $game->drawn_count = 0;
        $game->save();

        return $game;
    }

    /**
     * Draw a number (mark it as extracted on the board).
     */
    public function drawNumber(int $number): void
    {
        $state = $this->board_state;
        $state[$number] = true;
        $this->board_state = $state;
        $this->last_drawn_number = $number;
        $this->drawn_count = ($this->drawn_count ?? 0) + 1;
        $this->save();
    }

    /**
     * Undo a drawn number (unmark it from the board).
     */
    public function undoNumber(int $number): void
    {
        $state = $this->board_state;

        if (!($state[$number] ?? false)) {
            return;
        }

        $state[$number] = false;
        $this->board_state = $state;
        $this->drawn_count = max(0, ($this->drawn_count ?? 0) - 1);

        if ($this->last_drawn_number === $number) {
            $this->last_drawn_number = null;
        }

        $this->save();
    }

    /**
     * Check if a number has been drawn.
     */
    public function isDrawn(int $number): bool
    {
        $state = $this->board_state ?? [];
        return $state[$number] ?? false;
    }

    /**
     * Get all drawn numbers as an array of integers.
     */
    public function getDrawnNumbers(): array
    {
        $state = $this->board_state ?? [];
        return array_keys(array_filter($state));
    }
}
