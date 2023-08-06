<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

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
        'header_comment' => [
            'comment_type' => 'PHPDoc',
            'header' => "@copyright Kevin Hemker <kevin@hemkers.de>\n@license   MIT\n@see       https://github.com/KevinHemker/random-string",
        ],
    ])
;

return $config;
