<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Reports\Unit;

use Illuminate\Container\Container;
use PHPUnit\Framework\TestCase;
use function AlecRabbit\container;

class FunctionsTest extends TestCase
{
    /** @test */
    public function container(): void
    {
        $this->assertInstanceOf(Container::class, container());
    }
}
