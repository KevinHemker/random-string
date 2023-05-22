<?php

use PhpCsFixer\Finder;
use PhpCsFixer\Config;

$finder = Finder::create()
    ->in([__DIR__.'/src', __DIR__.'/tests'])
    ->ignoreDotFiles(true)
    ->files()
    ->name('*.php')
;

$config = new Config();
$config
    ->setFinder($finder)
    ->setCacheFile(__DIR__.'/.build/cache/php_cs.cache')
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        'yoda_style' => false,
        'declare_strict_types' => true,
    ])
;

return $config;
