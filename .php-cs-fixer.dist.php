<?php

return PhpCsFixer\Config::create()
  ->setRules([
    '@PSR2' => true,
    'no_extra_blank_lines' => ['tokens' => ['extra']],
  ])
  ->setFinder(
    PhpCsFixer\Finder::create()->in(__DIR__)
  );
