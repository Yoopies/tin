<?php

declare(strict_types=1);

namespace Yoopies\Tin\Tests;

use PHPUnit\Framework\TestCase;
use Yoopies\Tin\Exception\TINException;
use Yoopies\Tin\TIN;

final class TINTest extends TestCase
{
    public function testFromCountryCodeAndTin(): void
    {
        self::assertTrue(TIN::from('FR', '3023217600053')->isValid());
        self::assertTrue(TIN::from('fr', '3023217600053')->check());
    }

    public function testFromSlug(): void
    {
        self::assertTrue(TIN::fromSlug('FR3023217600053')->isValid());
        self::assertTrue(TIN::fromSlug(' FR3023217600053')->isValid());
        self::assertFalse(TIN::fromSlug('FR1111111111111')->isValid());
    }

    public function testNonStrictModeNormalizesTin(): void
    {
        self::assertTrue(TIN::from('BE', '000125.111.19')->isValid());
    }

    public function testNonStrictModeStripsSpaces(): void
    {
        self::assertTrue(TIN::from('BE', '000125 111 19')->isValid());
    }

    public function testStrictModeDoesNotStripSeparators(): void
    {
        self::assertFalse(TIN::from('BE', '000125.111.19')->isValid(true));
        self::assertFalse(TIN::from('BE', '000125 111 19')->isValid(true));
        self::assertTrue(TIN::from('BE', '00012511119')->isValid(true));
    }

    public function testStrictModeIsCaseInsensitive(): void
    {
        self::assertTrue(TIN::from('IT', 'dmlpry77d15h501f')->isValid(true));
    }

    public function testStrictModeKeepsSpanishZeroPadding(): void
    {
        self::assertTrue(TIN::from('ES', '54237A')->isValid(true));
    }

    public function testCheckThrowsOnEmptySlug(): void
    {
        $this->expectException(TINException::class);
        $this->expectExceptionMessage('Invalid Slug. Reason: Void string.');

        TIN::fromSlug('')->check();
    }

    public function testCheckThrowsOnUnsupportedCountry(): void
    {
        $this->expectException(TINException::class);
        $this->expectExceptionMessage('No handler available for this country code: US.');

        TIN::from('US', '123456789')->check();
    }

    public function testIsCountrySupported(): void
    {
        self::assertTrue(TIN::isCountrySupported('FR'));
        self::assertTrue(TIN::isCountrySupported('uk'));
        self::assertFalse(TIN::isCountrySupported('US'));
    }
}
