<?php declare(strict_types=1);
require \dirname(__DIR__) . '/vendor/autoload.php';

use React\EventLoop\Factory as EventLoopFactory;
use function WyriHaximus\React\childProcessPromiseClosure;

$loop = EventLoopFactory::create();

childProcessPromiseClosure($loop, function () {
    return ['time'=>\time()];
})->done(function ($time): void {
    echo $time['time'], \PHP_EOL;
}, function (Throwable $throwable): void {
    echo (string)$throwable;
});

$loop->run();
