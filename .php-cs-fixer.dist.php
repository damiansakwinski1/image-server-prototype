<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var');

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR1' => true,
        '@PSR2' => true,
        '@Symfony' => true,
        'declare_strict_types' => true,
        'fully_qualified_strict_types' => true,
        'explicit_string_variable' => true,
    ])
    ->setFinder($finder);
