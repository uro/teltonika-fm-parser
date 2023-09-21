<?php

declare(strict_types=1);

$finder = new PhpCsFixer\Finder();
$finder
    ->path('src')
    ->files()
    ->name('*.php')
    ->in(__DIR__);

$config = (new PhpCsFixer\Config())->setFinder($finder);

return $config;

