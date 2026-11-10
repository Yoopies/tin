<?php

declare(strict_types=1);

namespace Yoopies\Tin\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Yoopies\Tin\CountryHandler\CountryHandlerInterface;
use Yoopies\Tin\Exception\TINException;

final class CountryHandlerTest extends TestCase
{
    private const REASONS = [
        'length' => 'Invalid length',
        'pattern' => 'Invalid pattern',
        'date' => 'Invalid date',
        'syntax' => 'Invalid syntax',
    ];

    #[DataProvider('provideValidTins')]
    public function testValidTin(string $country, string $tin): void
    {
        self::assertTrue(self::handler($country)->validate($tin));
    }

    #[DataProvider('provideInvalidTins')]
    public function testInvalidTin(string $country, string $tin, string $reason): void
    {
        $this->expectException(TINException::class);
        $this->expectExceptionMessage(sprintf('Invalid TIN(%s). Reason: %s.', $tin, self::REASONS[$reason]));

        self::handler($country)->validate($tin);
    }

    /**
     * @return iterable<string, array{string, string}>
     */
    public static function provideValidTins(): iterable
    {
        foreach (self::fixtures() as $country => $cases) {
            foreach ($cases['valid'] ?? [] as $tin) {
                yield sprintf('%s %s', $country, $tin) => [$country, $tin];
            }
        }
    }

    /**
     * @return iterable<string, array{string, string, string}>
     */
    public static function provideInvalidTins(): iterable
    {
        foreach (self::fixtures() as $country => $cases) {
            foreach (array_keys(self::REASONS) as $reason) {
                foreach ($cases[$reason] ?? [] as $tin) {
                    yield sprintf('%s %s %s', $country, $reason, $tin) => [$country, $tin, $reason];
                }
            }
        }
    }

    /**
     * @return array<string, array<string, list<string>>>
     */
    private static function fixtures(): array
    {
        return require __DIR__ . '/fixtures.php';
    }

    private static function handler(string $country): CountryHandlerInterface
    {
        $class = 'Yoopies\\Tin\\CountryHandler\\' . $country;

        return new $class();
    }
}
