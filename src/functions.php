<?php

declare(strict_types=1);

namespace WyriHaximus\React;

use Closure;
use Opis\Closure\SerializableClosure;
use React\ChildProcess\Process;
use React\EventLoop\LoopInterface;
use React\Promise\PromiseInterface;

use function base64_encode;
use function dirname;
use function escapeshellarg;
use function escapeshellcmd;
use function Safe\json_decode;
use function serialize;

use const DIRECTORY_SEPARATOR;
use const PHP_BINARY;
use const PHP_SAPI;

/**
 * @return PromiseInterface<mixed>
 *
 * @psalm-suppress TooManyTemplateParams
 * @phpstan-ignore-next-line
 */
function childProcessPromiseClosure(LoopInterface $loop, Closure $closure): PromiseInterface
{
    $cmd = escapeshellarg(PHP_BINARY . (PHP_SAPI === 'phpdbg' ? ' -qrr --' : '')) . ' ' . dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'run.php ' . escapeshellcmd(base64_encode(serialize(new SerializableClosure($closure))));

    /**
     * @psalm-suppress MissingClosureReturnType
     */
    return childProcessPromise($loop, new Process($cmd))->then(static fn (ProcessOutcome $processOutcome) => json_decode($processOutcome->getStdout(), true));
}
