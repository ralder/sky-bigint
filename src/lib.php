<?php declare(strict_types = 1);
namespace sky\fn;

use InvalidArgumentException;

function sumBigInt(string $a, string $b): string
{
    validateBigInt($a);
    validateBigInt($b);

    $result = '';

    $digitsA = array_reverse(str_split($a)); 
    $digitsB = array_reverse(str_split($b)); 
    $max = max(count($digitsA), count($digitsB));

    $append = 0;
    for ($i = 0; $i < $max; $i++) {
        $digitA = $digitsA[$i] ?? 0;
        $digitB = $digitsB[$i] ?? 0;

        $sum = $digitA + $digitB + $append;
        if ($sum < 10) {
            $result .= (string) $sum;
            $append = 0;
        } else {
            list($part1, $part2) = str_split((string) $sum);
            $result .= $part2;
            $append = (int) $part1;
        }
    }

    if ($append > 0) {
        $result .= $append;
    }

    return strrev($result);
}

function validateBigInt(string $digits): void
{
    if (!preg_match('/^\d+$/', $digits)) {
        throw new InvalidArgumentException('Digits shoud be contains only 0-9 symbols');
    }
}

