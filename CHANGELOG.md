# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- `.gitattributes` for cleaner distribution archives
- GitHub Actions workflow example in README
- Known Issues section in README
- Recommended `.gitignore` entries in README

### Changed
- Removed hardcoded `src/` path from PHPStan config for better flexibility
- Manual PHPStan commands now require explicit path argument
- Improved documentation for baseline file requirement

### Fixed
- Removed `tests/` path from PHPStan ignoreErrors (caused failures when projects don't have tests directory)

## [1.0.0] - 2025-01-27

### Added
- Initial release
- Zero-config GrumPHP pre-commit hooks
- PHPStan level 9 with strict rules, deprecation warnings, bleeding edge
- PHP-CS-Fixer with PER-CS rules and comprehensive non-risky ruleset
- Support for PHP 8.2+
- Automatic installation of git hooks on `composer install`
- Only analyzes changed files for fast pre-commit validation
