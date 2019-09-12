<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use newsworthy39\Factory\Tinker;

function is_cli()
{
    return !http_response_code();
}

if (is_cli() && $argc > 1) {
    $method = 'up';
    $object = new Tinker();
    $class_name = get_class($object);
    $methods = get_class_methods($class_name);
    if (in_array($argv[1], $methods)) {

        $object->{$argv[1]}();
    }
}
