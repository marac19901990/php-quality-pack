# PHP Quality Pack

Zero-config PHP code quality standards with GrumPHP, PHPStan, and PHP-CS-Fixer. Installs pre-commit hooks that automatically run static analysis and code style fixes on every commit.

## What It Does

- **Installs GrumPHP pre-commit hooks** automatically on `composer install`
- **Runs PHPStan** (level 9, strict rules, deprecation warnings) on every commit
- **Runs PHP-CS-Fixer** (PSR-12 + sensible rules) on every commit
- **Zero-config** - works out of the box with sensible defaults
- **Only checks changed files** for fast pre-commit validation

## Default Standards

| Tool | Configuration |
|------|---------------|
| PHPStan | Level 9, strict rules, deprecation warnings, bleeding edge |
| PHP-CS-Fixer | PSR-12, sorted imports, trailing commas, single quotes |
| PHP Version | 8.2+ required |

## Requirements

This package intentionally requires modern versions:

- **PHP 8.2+** - Modern PHP only
- **PHPStan 2.x** - Latest major version
- **PHP-CS-Fixer 3.x** - Latest stable

Legacy projects requiring older versions should not use this pack.

## Installation

```bash
composer require --dev marac19901990/php-quality-pack
```

## Setup

### 1. Update composer.json

Add the following to your project's `composer.json`:

```json
{
    "extra": {
        "grumphp": {
            "config-default-path": "vendor/marac19901990/php-quality-pack/rules/grumphp.yml"
        }
    },
    "config": {
        "allow-plugins": {
            "phpro/grumphp": true,
            "phpstan/extension-installer": true
        }
    }
}
```

### 2. Create a PHPStan baseline file

Create an empty `phpstan-baseline.neon` in your project root:

```bash
echo "parameters:" > phpstan-baseline.neon
```

Or generate one with current errors (recommended for existing codebases):

```bash
vendor/bin/phpstan analyse -c vendor/marac19901990/php-quality-pack/rules/phpstan.neon --generate-baseline
```

### 3. Run composer install

```bash
composer install
```

**That's it!** GrumPHP hooks are automatically installed.

## Usage

### Just commit

```bash
git add .
git commit -m "Your commit message"
```

PHPStan and PHP-CS-Fixer run automatically on changed files. If there are issues, the commit is blocked until you fix them.

### Manual checks

```bash
# Run all checks on changed files
vendor/bin/grumphp run

# Run PHPStan on entire codebase
vendor/bin/phpstan analyse -c vendor/marac19901990/php-quality-pack/rules/phpstan.neon

# Run PHP-CS-Fixer on entire codebase (dry-run)
vendor/bin/php-cs-fixer fix --config=vendor/marac19901990/php-quality-pack/rules/php-cs-fixer.php --dry-run --diff

# Auto-fix code style issues
vendor/bin/php-cs-fixer fix --config=vendor/marac19901990/php-quality-pack/rules/php-cs-fixer.php
```

### Regenerate baseline

When you've fixed PHPStan errors or want to capture existing ones:

```bash
vendor/bin/phpstan analyse -c vendor/marac19901990/php-quality-pack/rules/phpstan.neon --generate-baseline
```

## Customization

For most projects, the default configuration works out of the box. Only customize if you have specific needs.

### Override GrumPHP tasks

Create a local `grumphp.yml` in your project root:

```yaml
imports:
    - { resource: vendor/marac19901990/php-quality-pack/rules/grumphp.yml }

grumphp:
    tasks:
        phpcsfixer:
            diff: false  # Example: disable diff output
```

Then update `config-default-path` in `composer.json`:

```json
"grumphp": {
    "config-default-path": "grumphp.yml"
}
```

### Add additional PHPStan paths or ignores

Create a local `phpstan.neon`:

```neon
includes:
    - vendor/marac19901990/php-quality-pack/rules/phpstan.neon
    - phpstan-baseline.neon

parameters:
    paths:
        - src
        - lib  # Additional paths

    ignoreErrors:
        - message: "#^Project-specific error to ignore$#"
```

Then create a `grumphp.yml` that points to your local config.

### Adding framework-specific extensions

This package includes only base PHPStan extensions. Add framework-specific extensions to your project:

```bash
# For Symfony projects
composer require --dev phpstan/phpstan-symfony

# For PHPUnit
composer require --dev phpstan/phpstan-phpunit

# For Doctrine
composer require --dev phpstan/phpstan-doctrine
```

The `phpstan/extension-installer` automatically registers these extensions.

## Two Usage Models

### 1. Direct Use (Generic Defaults)

Use directly via `composer require` if you're happy with:
- PSR-12 coding standards
- PHPStan level 9 with strict rules
- Deprecation warnings enabled

Good for: personal projects, new projects, teams aligned with these standards.

### 2. Fork and Customize

Fork this repo to create your organization's version:

1. Fork to `your-org/php-quality-pack`
2. Modify `rules/` files to your standards:
   - Change PHPStan level in `rules/phpstan.neon`
   - Adjust PHP-CS-Fixer rules in `rules/php-cs-fixer.php`
   - Add/remove GrumPHP tasks in `rules/grumphp.yml`
3. Update paths in `rules/grumphp.yml` to your vendor name
4. Publish to Packagist as your org's package

Good for: organizations with specific coding standards.

## Default Configuration Details

### PHPStan (`rules/phpstan.neon`)
- Level 9 (strictest)
- Strict rules enabled
- Deprecation warnings enabled
- Bleeding edge rules enabled
- Analyzes `src/` directory
- Includes project's `phpstan-baseline.neon`

### PHP-CS-Fixer (`rules/php-cs-fixer.php`)
- PSR-12 ruleset
- Short array syntax (`[]` not `array()`)
- Unused imports removed
- Imports sorted alphabetically
- Single quotes preferred
- Trailing commas in multiline structures
- Snake_case PHPUnit method names allowed

### GrumPHP (`rules/grumphp.yml`)
- Only analyzes changed files (fast pre-commit checks)
- Stops on first failure
- Local git hooks

## Migration from Local Configs

If your project has local `phpstan.neon`, `grumphp.yml`, or `.php-cs-fixer.dist.php`:

1. **Regenerate baseline**: Run `vendor/bin/phpstan analyse -c vendor/marac19901990/php-quality-pack/rules/phpstan.neon --generate-baseline`
2. **Delete local configs**: Remove `phpstan.neon`, `grumphp.yml`, `.php-cs-fixer.dist.php`
3. **Update composer.json**: Set `config-default-path` to `vendor/marac19901990/php-quality-pack/rules/grumphp.yml`
4. **Run composer install**: Reinstalls GrumPHP hooks with new config

## Makefile Updates

If your project uses Makefile targets, update them to use the vendor config paths:

```makefile
stan: ## Run PHPStan
	vendor/bin/phpstan analyse -c vendor/marac19901990/php-quality-pack/rules/phpstan.neon

stan-baseline: ## Generate PHPStan baseline
	vendor/bin/phpstan analyse -c vendor/marac19901990/php-quality-pack/rules/phpstan.neon --generate-baseline

cs-fix: ## Run PHP-CS-Fixer
	vendor/bin/php-cs-fixer fix --config vendor/marac19901990/php-quality-pack/rules/php-cs-fixer.php

cs-check: ## Check code style (dry-run)
	vendor/bin/php-cs-fixer fix --config vendor/marac19901990/php-quality-pack/rules/php-cs-fixer.php --dry-run --diff
```

## License

MIT License - see [LICENSE](LICENSE) for details.
