<?php

declare(strict_types=1);

namespace Yoopies\Tin\CountryHandler;

use function in_array;
use function strlen;

use const FILE_IGNORE_NEW_LINES;

/**
 * Italy.
 */
final class Italy extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'IT';

    /**
     * @var string
     */
    public const IT_ID_LIST_PATH = __DIR__ . '/../../resources/IT_ID_list';

    /**
     * @var int
     */
    public const LENGTH = 16;

    // phpcs:disable

    /**
     * @var string
     */
    public const PATTERN = '[a-zA-Z]{6}[LMNPQRSTUVlmnpqrstuv0-9]{2}[ABCDEHLMPRSTabcdehlmprst]([0Ll][1-9]|[1Mm2Nn4Qq5Rr6Ss][0-9]|[3Pp7Tt][0-1])[a-zA-Z][LMNPQRSTUVlmnpqrstuv0-9]{3}[a-zA-Z]';

    // phpcs:enable

    /**
     * @var array<int, string>
     */
    private array $listSet = [];

    protected function hasValidDate(string $tin): bool
    {
        $day = (int) ($this->convertCharToNumber(substr($tin, 9, 2)));
        $c9 = $tin[8];
        $month = $this->getMonthNumber($c9);
        $year = (int) ($this->convertCharToNumber(substr($tin, 6, 2)));

        if (1 <= $day && 31 >= $day) {
            $d1 = checkdate($month, $day, 1900 + $year);
            $d2 = checkdate($month, $day, 2000 + $year);

            return $d1 || $d2;
        }

        $d1 = checkdate($month, $day - 40, 1900 + $year);
        $d2 = checkdate($month, $day - 40, 2000 + $year);

        return 41 <= $day && 71 >= $day && ($d1 || $d2);
    }

    protected function hasValidPattern(string $tin): bool
    {
        if (false !== $listSet = file(self::IT_ID_LIST_PATH, FILE_IGNORE_NEW_LINES)) {
            $this->listSet = $listSet;
        }

        $code = substr($tin, 11, 1) . $this->convertCharToNumber(substr($tin, 12, 3));

        $containsUpper = in_array($code, $this->listSet, true);
        $containsLower = in_array(strtolower($code), $this->listSet, true);

        return ($containsUpper || $containsLower) && parent::hasValidPattern($tin);
    }

    protected function hasValidRule(string $tin): bool
    {
        $sum = 0;

        for ($i = 0; 15 > $i; ++$i) {
            $sum += 0 === $i % 2 ?
                $this->convertOddCharacter($tin[$i]) :
                $this->convertEvenCharacter($tin[$i]);
        }
        $remainderBy26 = $sum % 26;
        $c16 = $tin[15];
        $check = $this->getAlphabeticalPosition($c16) - 1;

        return $remainderBy26 === $check;
    }

    private function convertCharToNumber(string $oldStr): string
    {
        $newStr = '';

        for ($i = 0; strlen($oldStr) > $i; ++$i) {
            $newStr .= $this->getNumberFromChar($oldStr[$i]);
        }

        return $newStr;
    }

    private function convertEvenCharacter(string $c): int
    {
        if (is_numeric($c)) {
            return (int) $c;
        }

        return $this->getAlphabeticalPosition($c) - 1;
    }

    private function convertOddCharacter(string $c): int
    {
        return match ($c) {
            '0', 'A' => 1,
            '1', 'B' => 0,
            '2', 'C' => 5,
            '3', 'D' => 7,
            '4', 'E' => 9,
            '5', 'F' => 13,
            '6', 'G' => 15,
            '7', 'H' => 17,
            '8', 'I' => 19,
            '9', 'J' => 21,
            'K' => 2,
            'L' => 4,
            'M' => 18,
            'N' => 20,
            'O' => 11,
            'P' => 3,
            'Q' => 6,
            'R' => 8,
            'S' => 12,
            'T' => 14,
            'U' => 16,
            'V' => 10,
            'W' => 22,
            'X' => 25,
            'Y' => 24,
            'Z' => 23,
            default => -1,
        };
    }

    private function getMonthNumber(string $m): int
    {
        return match ($m) {
            'A' => 1,
            'B' => 2,
            'C' => 3,
            'D' => 4,
            'E' => 5,
            'H' => 6,
            'L' => 7,
            'M' => 8,
            'P' => 9,
            'R' => 10,
            'S' => 11,
            'T' => 12,
            default => -1,
        };
    }

    private function getNumberFromChar(string $m): int
    {
        if (is_numeric($m)) {
            return (int) $m;
        }

        return match ($m) {
            'L' => 0,
            'M' => 1,
            'N' => 2,
            'P' => 3,
            'Q' => 4,
            'R' => 5,
            'S' => 6,
            'T' => 7,
            'U' => 8,
            'V' => 9,
            default => -1,
        };
    }
}
