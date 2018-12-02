<?php declare(strict_types=1);

namespace WyriHaximus\React;

use Closure;
use React\EventLoop\LoopInterface;
use React\Promise\Deferred;
use React\Promise\PromiseInterface;
use Throwable;
use WyriHaximus\React\ChildProcess\Closure\ClosureChild;
use WyriHaximus\React\ChildProcess\Closure\MessageFactory;
use WyriHaximus\React\ChildProcess\Messenger\Factory;
use WyriHaximus\React\ChildProcess\Messenger\Messages\Payload;
use WyriHaximus\React\ChildProcess\Messenger\Messenger;

/**
 * @param  LoopInterface    $loop
 * @param  Closure          $closure
 * @return PromiseInterface
 */
function childProcessPromiseClosure(LoopInterface $loop, Closure $closure): PromiseInterface
{
    return Factory::parentFromClass(ClosureChild::class, $loop)->then(function (Messenger $messenger) use ($closure) {
        $deferred = new Deferred();
        $messenger->on('error', function (Throwable $throwable) use ($deferred, $messenger): void {
            $deferred->reject($throwable);
            $messenger->softTerminate();
        });

        $messenger->rpc(MessageFactory::rpc($closure))->done(function (Payload $payload) use ($deferred, $messenger): void {
            $deferred->resolve($payload->getPayload());
            $messenger->softTerminate();
        }, function (Throwable $throwable) use ($deferred, $messenger): void {
            $deferred->reject($throwable);
            $messenger->softTerminate();
        });

        return $deferred->promise();
    });
}
