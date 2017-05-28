<?php declare(strict_types=1);

namespace WyriHaximus\React\Tests\ChildProcess\Closure;

use PHPUnit\Framework\TestCase;
use React\EventLoop\Factory;
use function Clue\React\Block\await;
use function WyriHaximus\React\childProcessPromiseClosure;

final class ChildProcessPromiseClosureTest extends TestCase
{
    public function testChildProcessPromiseClosure()
    {
        $loop = Factory::create();

        $data = 1337;
        $result = await(
            childProcessPromiseClosure($loop, function () use ($data) {
                return [$data];
            }),
            $loop
        );
        $loop->run();

        self::assertSame([1337], $result);
    }
}
