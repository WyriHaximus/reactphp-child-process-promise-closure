<?php declare(strict_types=1);
require \dirname(__DIR__) . '/vendor/autoload.php';

use React\EventLoop\Factory as EventLoopFactory;
use function WyriHaximus\React\childProcessPromiseClosure;

$loop = EventLoopFactory::create();

for ($i = 1; $i < 31; $i++) {
    $delay = $i;
    echo \time(), ': ', $delay, PHP_EOL;
    childProcessPromiseClosure($loop, function () use ($delay) {
        \sleep($delay * 2);

        return ['time'=>\time()];
    })->done(function ($time): void {
        echo \time(), ': ', $time['time'], PHP_EOL;
    }, function (Throwable $throwable): void {
        echo (string)$throwable;
    });
}

$loop->run();
