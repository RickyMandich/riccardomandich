<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

/**
 * Custom Eloquent Cast: converts a 12-byte binary string (bit-packed)
 * into an associative array [1..90 => bool] and vice versa.
 *
 * Each bit represents one tombola number (1-90).
 * Byte index = floor((N-1) / 8), Bit position = (N-1) % 8
 */
class BoardStateCast implements CastsAttributes
{
    /**
     * Binary string → array<int, bool>
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): array
    {
        // Default: all numbers not drawn
        if ($value === null) {
            return array_fill_keys(range(1, 90), false);
        }

        $result = [];
        for ($i = 1; $i <= 90; $i++) {
            $byteIndex = intdiv($i - 1, 8);
            $bitPosition = ($i - 1) % 8;

            if ($byteIndex < strlen($value)) {
                $byte = ord($value[$byteIndex]);
                $result[$i] = (bool)(($byte >> $bitPosition) & 1);
            } else {
                $result[$i] = false;
            }
        }

        return $result;
    }

    /**
     * array<int, bool> → binary string (12 bytes)
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        $bytes = array_fill(0, 12, 0);

        if (is_array($value)) {
            foreach ($value as $number => $drawn) {
                if ($drawn && $number >= 1 && $number <= 90) {
                    $byteIndex = intdiv($number - 1, 8);
                    $bitPosition = ($number - 1) % 8;
                    $bytes[$byteIndex] |= (1 << $bitPosition);
                }
            }
        }

        return implode('', array_map('chr', $bytes));
    }
}
