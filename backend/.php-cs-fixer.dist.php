<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude(['bootstrap/cache', 'config', 'storage'])
;

return (new PhpCsFixer\Config)
    ->setRules([
        '@PSR2' => true,
        '@Symfony:risky' => true,
        'array_syntax' => ['syntax' => 'short'],
        'blank_line_after_namespace' => true,
        'blank_line_after_opening_tag' => true,
        'blank_line_before_statement' => ['statements' => ['declare', 'return', 'throw', 'try']],
        'class_attributes_separation' => ['elements' => ['const' => 'one', 'method' => 'one', 'property' => 'one', 'trait_import' => 'none', 'case' => 'none']],
        'combine_consecutive_issets' => true,
        'combine_consecutive_unsets' => true,
        'combine_nested_dirname' => true,
        'concat_space' => ['spacing' => 'one'],
        'constant_case' => ['case' => 'lower'],
        'declare_strict_types' => true,
        'dir_constant' => true,
        'elseif' => true,
        'encoding' => true,
        'fopen_flag_order' => true,
        'fopen_flags' => ['b_mode' => true],
        'full_opening_tag' => true,
        'general_phpdoc_annotation_remove' => ['annotations' => ['author', 'package']],
        'include' => true,
        'is_null' => true,
        'line_ending' => true,
        'lowercase_keywords' => true,
        'mb_str_functions' => false,
        'method_argument_space' => true,
        'method_chaining_indentation' => true,
        'modernize_types_casting' => true,
        'native_constant_invocation' => true,
        'native_function_casing' => true,
        'no_unused_imports' => true,
        'ordered_imports' => true,
        'ordered_traits' => true,
        'phpdoc_line_span' => [
            'const' => 'multi',
            'property' => 'multi',
            'method' => 'multi',
        ],
        'phpdoc_no_useless_inheritdoc' => true,
        'phpdoc_order' => true,
        'phpdoc_scalar' => [],
        'phpdoc_separation' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_types_order' => ['sort_algorithm' => 'none'],
        'phpdoc_var_annotation_correct_order' => true,
        'phpdoc_var_without_name' => true,
        'protected_to_private' => true,
        'single_quote' => true,
        'strict_comparison' => true,
        'ternary_operator_spaces' => true,
        'trailing_comma_in_multiline' => true,
        'visibility_required' => ['elements' => ['const', 'property', 'method']],
    ])
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setUsingCache(false)
    ;
