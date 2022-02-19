<?php

declare(strict_types=1);

namespace WyriHaximus\React;

use function function_exists;

if (! function_exists('WyriHaximus\React\childProcessPromiseClosure')) {
    require __DIR__ . '/functions.php';
}
