<?php declare(strict_types=1);

namespace AlecRabbit\Tests;

use AlecRabbit\Reports\Core\Formattable;
use PHPUnit\Framework\TestCase;

class AbstractFormatterTest extends TestCase
{
    /** @var ExtendsAbstractFormatter */
    private $obj;

    /** @test */
    public function check(): void
    {
        $str =
            $this->obj->format(
                new class extends Formattable
                {
                }
            );
        $this->assertStringContainsString(ExtendsAbstractFormatter::EXPECTED_CLASS_STUB, $str);
        $this->assertStringContainsString('expected', $str);
        $this->assertStringContainsString('given.', $str);
    }

    protected function setUp(): void
    {
        $this->obj = new ExtendsAbstractFormatter();
    }
}
