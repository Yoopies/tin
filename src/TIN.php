<?php

declare(strict_types=1);

namespace Yoopies\Tin;

use Yoopies\Tin\CountryHandler\Austria;
use Yoopies\Tin\CountryHandler\Belgium;
use Yoopies\Tin\CountryHandler\Bulgaria;
use Yoopies\Tin\CountryHandler\CountryHandlerInterface;
use Yoopies\Tin\CountryHandler\Croatia;
use Yoopies\Tin\CountryHandler\Cyprus;
use Yoopies\Tin\CountryHandler\CzechRepublic;
use Yoopies\Tin\CountryHandler\Denmark;
use Yoopies\Tin\CountryHandler\Estonia;
use Yoopies\Tin\CountryHandler\Finland;
use Yoopies\Tin\CountryHandler\France;
use Yoopies\Tin\CountryHandler\Germany;
use Yoopies\Tin\CountryHandler\Greece;
use Yoopies\Tin\CountryHandler\Hungary;
use Yoopies\Tin\CountryHandler\Ireland;
use Yoopies\Tin\CountryHandler\Italy;
use Yoopies\Tin\CountryHandler\Latvia;
use Yoopies\Tin\CountryHandler\Lithuania;
use Yoopies\Tin\CountryHandler\Luxembourg;
use Yoopies\Tin\CountryHandler\Malta;
use Yoopies\Tin\CountryHandler\Netherlands;
use Yoopies\Tin\CountryHandler\Poland;
use Yoopies\Tin\CountryHandler\Portugal;
use Yoopies\Tin\CountryHandler\Romania;
use Yoopies\Tin\CountryHandler\Slovakia;
use Yoopies\Tin\CountryHandler\Slovenia;
use Yoopies\Tin\CountryHandler\Spain;
use Yoopies\Tin\CountryHandler\Sweden;
use Yoopies\Tin\CountryHandler\UnitedKingdom;
use Yoopies\Tin\Exception\TINException;

/**
 * The main class to validate TIN numbers.
 */
final class TIN
{
    /**
     * @var array<string, class-string>
     */
    private static $algorithms = [
        'AT' => Austria::class,
        'BE' => Belgium::class,
        'BG' => Bulgaria::class,
        'CY' => Cyprus::class,
        'CZ' => CzechRepublic::class,
        'DE' => Germany::class,
        'DK' => Denmark::class,
        'EE' => Estonia::class,
        'ES' => Spain::class,
        'FI' => Finland::class,
        'FR' => France::class,
        'GR' => Greece::class,
        'HR' => Croatia::class,
        'HU' => Hungary::class,
        'IE' => Ireland::class,
        'IT' => Italy::class,
        'LT' => Lithuania::class,
        'LU' => Luxembourg::class,
        'LV' => Latvia::class,
        'MT' => Malta::class,
        'NL' => Netherlands::class,
        'PL' => Poland::class,
        'PT' => Portugal::class,
        'RO' => Romania::class,
        'SE' => Sweden::class,
        'SI' => Slovenia::class,
        'SK' => Slovakia::class,
        'UK' => UnitedKingdom::class,
    ];

    /**
     * @var string
     */
    private $slug;

    private function __construct(string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * @throws TINException
     */
    public function check(bool $strict = false): bool
    {
        $parsedTin = $this->parse($this->slug, $strict);

        return $this->getAlgorithm($parsedTin['country'])->validate($parsedTin['tin']);
    }

    public static function from(string $countryCode, string $tin): TIN
    {
        return self::fromSlug($countryCode . $tin);
    }

    public static function fromSlug(string $slug): TIN
    {
        return new self($slug);
    }

    public static function isCountrySupported(string $countryCode): bool
    {
        foreach (self::$algorithms as $algorithm) {
            if (true === $algorithm::supports($countryCode)) {
                return true;
            }
        }

        return false;
    }

    public function isValid(bool $strict = false): bool
    {
        try {
            $this->check($strict);
        } catch (TINException $e) {
            return false;
        }

        return true;
    }

    /**
     * @throws TINException
     */
    private function getAlgorithm(string $country): CountryHandlerInterface
    {
        foreach (self::$algorithms as $algorithm) {
            if (true === $algorithm::supports($country)) {
                $handler = new $algorithm();

                if ($handler instanceof CountryHandlerInterface) {
                    return $handler;
                }
            }
        }

        throw TINException::invalidCountry($country);
    }

    private function normalizeTin(string $tin): string
    {
        if (null !== $string = preg_replace('#[^[:alnum:]\-+]#u', '', $tin)) {
            return strtoupper($string);
        }

        return '';
    }

    /**
     * @throws TINException
     *
     * @return non-empty-array<'country'|'tin', string>
     */
    private function parse(string $slug, bool $strict): array
    {
        if ('' === $slug) {
            throw TINException::emptySlug();
        }

        [$country, $tin] = sscanf($slug, '%2s%s') + ['', ''];

        return [
            'country' => (string) $country,
            'tin' => true === $strict ? (string) $tin : $this->normalizeTin((string) $tin),
        ];
    }
}
