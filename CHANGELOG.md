# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.1.0] - 2025-01-29

### Changed
- Lowered PHPStan level from 9 to 5 for better adoption
- Level 5 catches real bugs while being less strict about type hints

### Added
- GitHub Actions CI workflow for PHP 8.2, 8.3, 8.4
- CI status badge in README

## [1.0.0] - 2025-01-28

### Added
- Initial release
- Zero-config GrumPHP pre-commit hooks
- PHPStan level 9 with strict rules, deprecation warnings, bleeding edge
- PHP-CS-Fixer with PER-CS rules and comprehensive non-risky ruleset
- Support for PHP 8.2+
- Automatic installation of git hooks on `composer install`
- Only analyzes changed files for fast pre-commit validation
- `.gitattributes` for cleaner distribution archives
- GitHub Actions workflow example in README
- Known Issues section in README
- Recommended `.gitignore` entries in README
