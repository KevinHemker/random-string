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
    ->setCacheFile(__DIR__.'/.build/php-cs-fixer/php_cs.cache')
    ->setRules([
        '@Symfony' => true,
        'yoda_style' => false,
    ])
;

return $config;
