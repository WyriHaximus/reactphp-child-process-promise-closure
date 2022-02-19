<?php

declare(strict_types=1);

namespace WyriHaximus\React\Tests\ChildProcess\Closure;

use React\EventLoop\Loop;
use WyriHaximus\AsyncTestUtilities\AsyncTestCase;

use function WyriHaximus\React\childProcessPromiseClosure;

/**
 * @internal
 */
final class ChildProcessPromiseClosureTest extends AsyncTestCase
{
    public function testChildProcessPromiseClosure(): void
    {
        $data   = 1337;
        $result = $this->await(
            childProcessPromiseClosure(Loop::get(), static fn (): array => [$data])
        );
        Loop::run();

        self::assertSame([1337], $result);
    }
}
