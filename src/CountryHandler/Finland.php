<?php

declare(strict_types=1);

namespace Yoopies\Tin\CountryHandler;

/**
 * Finland.
 */
final class Finland extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'FI';

    /**
     * @var int
     */
    public const LENGTH = 11;

    /**
     * @var string
     */
    public const PATTERN = '[0-3]\d[0-1]\d{3}[+-A]\d{3}[0-9A-Z]';

    protected function hasValidDate(string $tin): bool
    {
        $day = (int) (substr($tin, 0, 2));
        $month = (int) (substr($tin, 2, 2));
        $year = (int) (substr($tin, 4, 2));
        $c7 = substr($tin, 6, 1);

        if ('+' === $c7) {
            return checkdate($month, $day, 1800 + $year);
        }

        if ('-' === $c7) {
            return checkdate($month, $day, 1900 + $year);
        }

        return 'A' === $c7 && checkdate($month, $day, 2000 + $year);
    }

    protected function hasValidRule(string $tin): bool
    {
        $number = (int) (substr($tin, 0, 6) . substr($tin, 7, 3));
        $remainderBy31 = $number % 31;
        $c11 = $tin[10];

        return $this->getMatch($remainderBy31) === $c11;
    }

    private function getMatch(int $number): string
    {
        if (10 > $number) {
            return (string) $number;
        }

        return match ($number) {
            10 => 'A',
            11 => 'B',
            12 => 'C',
            13 => 'D',
            14 => 'E',
            15 => 'F',
            16 => 'H',
            17 => 'J',
            18 => 'K',
            19 => 'L',
            20 => 'M',
            21 => 'N',
            22 => 'P',
            23 => 'R',
            24 => 'S',
            25 => 'T',
            26 => 'U',
            27 => 'V',
            28 => 'W',
            29 => 'X',
            30 => 'Y',
            default => ' ',
        };
    }
}
