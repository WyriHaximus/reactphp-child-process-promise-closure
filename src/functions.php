<?php

declare(strict_types=1);

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
 * @return PromiseInterface<mixed>
 *
 * @psalm-suppress TooManyTemplateParams
 * @phpstan-ignore-next-line
 */
function childProcessPromiseClosure(LoopInterface $loop, Closure $closure): PromiseInterface
{
    /**
     * @psalm-suppress TooManyTemplateParams
     */
    return Factory::parentFromClass(ClosureChild::class, $loop)->then(static function (Messenger $messenger) use ($closure): PromiseInterface {
        $deferred = new Deferred();
        $messenger->on('error', static function (Throwable $throwable) use ($deferred, $messenger): void {
            $deferred->reject($throwable);
            $messenger->softTerminate();
        });

        $messenger->rpc(MessageFactory::rpc($closure))->then(static function (Payload $payload) use ($deferred, $messenger): void {
            $deferred->resolve($payload->getPayload());
            $messenger->softTerminate();
        }, static function (Throwable $throwable) use ($deferred, $messenger): void {
            $deferred->reject($throwable);
            $messenger->softTerminate();
        });

        return $deferred->promise();
    });
}
