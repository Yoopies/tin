<?php

declare(strict_types=1);

namespace Yoopies\Tin\CountryHandler;

/**
 * France.
 */
final class France extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'FR';

    /**
     * @var int
     */
    public const LENGTH = 13;

    /**
     * @var string
     */
    public const PATTERN = '[0-3]\d{12}';

    protected function hasValidRule(string $tin): bool
    {
        $number = (int) (substr($tin, 0, 10));

        $remainderBy511 = $number % 511;

        $checkDigits = match (true) {
            10 > $remainderBy511 => (int) substr($tin, 12),
            100 > $remainderBy511 => (int) substr($tin, 11),
            default => (int) substr($tin, 10),
        };

        return $remainderBy511 === $checkDigits;
    }
}
