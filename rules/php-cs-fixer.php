<?php

declare(strict_types=1);

use PhpCsFixer\Config;

// Find project root (where composer.json is)
$projectRoot = getcwd();

$finder = (new PhpCsFixer\Finder())
    ->in($projectRoot)
    ->exclude('var')
    ->exclude('vendor');

return (new Config())
    ->setFinder($finder)
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'no_unused_imports' => true,
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'single_quote' => true,
        'trailing_comma_in_multiline' => ['elements' => ['arrays', 'arguments', 'parameters']],
        'php_unit_method_casing' => false,
        'concat_space' => ['spacing' => 'one'],
        'cast_spaces' => ['space' => 'none'],
    ])
    ->setRiskyAllowed(true)
    ->setCacheFile('.php-cs-fixer.cache');
