<?php
$baseDir = __DIR__ . '/..';
$loader = include "{$baseDir}/vendor/autoload.php";
$loader->add('Kir\\Streams\\Common\\', "{$baseDir}/tests");