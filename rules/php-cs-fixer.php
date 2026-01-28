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
        // Base rulesets
        '@PER-CS' => true,
        '@PHP82Migration' => true,

        // String handling
        'single_quote' => true,
        'explicit_string_variable' => true,

        // Array rules
        'array_indentation' => true,
        'array_syntax' => ['syntax' => 'short'],
        'list_syntax' => ['syntax' => 'short'],
        'trim_array_spaces' => true,
        'trailing_comma_in_multiline' => [
            'elements' => ['arrays', 'arguments', 'parameters', 'match'],
        ],

        // Imports
        'no_unused_imports' => true,
        'ordered_imports' => [
            'sort_algorithm' => 'alpha',
            'imports_order' => ['class', 'function', 'const'],
        ],
        'global_namespace_import' => [
            'import_classes' => true,
            'import_functions' => false,
            'import_constants' => false,
        ],
        'no_leading_import_slash' => true,
        'single_import_per_statement' => true,
        'fully_qualified_strict_types' => true,

        // Spacing
        'blank_line_before_statement' => [
            'statements' => ['return', 'throw', 'try'],
        ],
        'no_extra_blank_lines' => [
            'tokens' => ['extra', 'throw', 'use', 'curly_brace_block'],
        ],
        'no_whitespace_in_blank_line' => true,
        'single_line_empty_body' => true,
        'type_declaration_spaces' => true,
        'concat_space' => ['spacing' => 'one'],
        'cast_spaces' => ['space' => 'none'],

        // Code cleanup (non-risky)
        'no_empty_statement' => true,
        'no_unneeded_braces' => true,
        'no_unneeded_control_parentheses' => true,

        // Types & declarations (non-risky)
        'declare_parentheses' => true,
        'short_scalar_cast' => true,
        'native_function_casing' => true,
        'class_attributes_separation' => [
            'elements' => ['const' => 'one', 'method' => 'one', 'property' => 'one'],
        ],

        // Class structure
        'ordered_class_elements' => [
            'order' => [
                'use_trait',
                'case',
                'constant_public',
                'constant_protected',
                'constant_private',
                'property_public',
                'property_protected',
                'property_private',
                'construct',
                'destruct',
                'magic',
                'phpunit',
                'method_public',
                'method_protected',
                'method_private',
            ],
        ],
        'yoda_style' => false,

        // PHPDoc (non-risky)
        'phpdoc_trim' => true,
        'phpdoc_indent' => true,
        'no_empty_phpdoc' => true,
        'no_blank_lines_after_phpdoc' => true,
        'phpdoc_single_line_var_spacing' => true,

        // PHPUnit
        'php_unit_method_casing' => false,
    ])
    ->setRiskyAllowed(true)
    ->setCacheFile('.php-cs-fixer.cache');
