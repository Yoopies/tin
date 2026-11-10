<?php

declare(strict_types=1);

namespace Yoopies\Tin\CountryHandler;

/**
 * Lithuania.
 */
final class Lithuania extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'LT';

    /**
     * @var int
     */
    public const LENGTH = 11;

    /**
     * @var string
     */
    public const PATTERN = '[1-6]\d{2}[0-1]\d[0-3]\d{5}';

    protected function hasValidRule(string $tin): bool
    {
        $sum = 0;
        $c11 = (int) (substr($tin, 10));

        for ($i = 0; 10 > $i; ++$i) {
            $sum += $this->multiplyAccordingToWeight((int) (substr($tin, $i, 1)), $i);
        }
        $remainderBy11 = $sum % 11;

        if (10 !== $remainderBy11) {
            return $c11 === $remainderBy11;
        }
        $sum2 = 0;

        for ($j = 0; 10 > $j; ++$j) {
            $sum2 += $this->multiplyAccordingToWeight2((int) (substr($tin, $j, 1)), $j);
        }
        $remainderBy11 = $sum2 % 11;

        if (10 === $remainderBy11) {
            return 0 === $c11;
        }

        return $c11 === $remainderBy11;
    }

    private function multiplyAccordingToWeight(int $val, int $index): int
    {
        return match ($index) {
            9, 0 => $val * 1,
            1 => $val * 2,
            2 => $val * 3,
            3 => $val * 4,
            4 => $val * 5,
            5 => $val * 6,
            6 => $val * 7,
            7 => $val * 8,
            8 => $val * 9,
            default => -1,
        };
    }

    private function multiplyAccordingToWeight2(int $val, int $index): int
    {
        return match ($index) {
            9, 0 => $val * 3,
            1 => $val * 4,
            2 => $val * 5,
            3 => $val * 6,
            4 => $val * 7,
            5 => $val * 8,
            6 => $val * 9,
            7 => $val * 1,
            8 => $val * 2,
            default => -1,
        };
    }
}
