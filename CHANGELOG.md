# Changelog

## [1.0.0] - 2026-11-10

### Breaking changes
- PHP 8.2 minimum is now required (was PHP 7.4).
- `CountryHandlerInterface::validate()` now takes a `bool $strict = false` second argument.
- `CountryHandler::normalizeTin()` now takes a `bool $strict` second argument.
- `check(true)` / `isValid(true)` now reject TINs containing spaces, dots, slashes... (strict mode used to be ignored).

### Fixed
- Strict mode is now honored: the TIN is only uppercased (Spanish zero-padding is kept).
- A TIN containing spaces is no longer truncated at the first space.
- Cyprus: the pattern now accepts TINs starting with `6` (and no longer with `,`).

### Changed
- Modernized the code base for PHP 8.2 (readonly class, typed properties, constants, `match`).

### Added
- PHPUnit test suite covering every country handler (`composer test`).

## [0.0.2] - 2025-08-01

### Fixed
- Italy: added the missing `resources/IT_ID_list` file.

## [0.0.1] - 2025-04-08

- Initial release, based on [loophp/tin](https://github.com/loophp/tin) with PHP 7.4 support.
