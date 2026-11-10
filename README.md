# Taxpayer Identification Number (TIN) Validator

## Description

Based on https://github.com/loophp/tin, adapted for Yoopies.

## Requirements

- PHP 8.2 or higher

## Usage

```php
use Yoopies\Tin\TIN;
use Yoopies\Tin\Exception\TINException;

TIN::from('FR', '3023217600053')->isValid(); // true
TIN::fromSlug('FR3023217600053')->isValid(); // true
TIN::isCountrySupported('FR');               // true

// Non-alphanumeric characters (except '-' and '+') are stripped by default.
TIN::from('BE', '000125.111.19')->isValid();     // true
// Strict mode keeps them (the TIN is still uppercased).
TIN::from('BE', '000125.111.19')->isValid(true); // false

try {
    TIN::from('FR', '1111111111111')->check();
} catch (TINException $e) {
    echo $e->getMessage(); // Invalid TIN(1111111111111). Reason: Invalid syntax.
}
```

## Tests

```bash
composer install
composer test
```
