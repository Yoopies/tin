<?php

declare(strict_types=1);

namespace Yoopies\Tin\CountryHandler;

use function ord;

/**
 * Cyprus.
 */
final class Cyprus extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'CY';

    /**
     * @var int
     */
    public const LENGTH = 9;

    /**
     * @var string
     */
    public const PATTERN = '[069]\d{7}[A-Z]';

    protected function hasValidRule(string $tin): bool
    {
        $c1 = $this->digitAt($tin, 0);
        $c2 = $this->digitAt($tin, 1);
        $c3 = $this->digitAt($tin, 2);
        $c4 = $this->digitAt($tin, 3);
        $c5 = $this->digitAt($tin, 4);
        $c6 = $this->digitAt($tin, 5);
        $c7 = $this->digitAt($tin, 6);
        $c8 = $this->digitAt($tin, 7);
        $c9 = ord($tin[8]);

        $evenPositionNumbersSum = $c2 + $c4 + $c6 + $c8;

        $recodedSum = array_sum([
            $this->recodeValue($c1),
            $this->recodeValue($c3),
            $this->recodeValue($c5),
            $this->recodeValue($c7),
        ]);

        $remainderBy26 = ($evenPositionNumbersSum + $recodedSum) % 26;

        return $remainderBy26 + 65 === $c9;
    }

    private function recodeValue(int $x): int
    {
        return match ($x) {
            1 => 0,
            2 => 5,
            3 => 7,
            4 => 9,
            5 => 13,
            6 => 15,
            7 => 17,
            8 => 19,
            9 => 21,
            default => 1,
        };
    }
}
