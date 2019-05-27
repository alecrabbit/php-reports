<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Reports;

use AlecRabbit\Formatters\DefaultFormatter;
use AlecRabbit\Reports\Core\AbstractReport;
use AlecRabbit\Reports\Core\AbstractReportable;
use AlecRabbit\Reports\DefaultReport;
use AlecRabbit\Tests\MockedFormatter;
use AlecRabbit\Tests\MockedReport;
use AlecRabbit\Tests\MockedReportable;
use Illuminate\Contracts\Container\BindingResolutionException;
use PHPUnit\Framework\TestCase;

class ReportTest extends TestCase
{
    /** @test
     * @throws BindingResolutionException
     */
    public function first(): void
    {
        $o = new MockedReportable();
        $report = $o->report();
        $this->assertInstanceOf(MockedReport::class, $report);
        $this->assertInstanceOf(MockedReportable::class, $report->getReportable());
        $this->assertInstanceOf(MockedFormatter::class, $report->getFormatter());
        $str = 'Value: 2';
        $this->assertEquals($str, (string)$report);
        $this->assertEquals($str, $report->getFormatter()->format($report));

        $f = new class extends MockedFormatter
        {
            protected function simple(array $data): string
            {
                return
                    sprintf(
                        'ValueEquals: %s',
                        $data['value']
                    );
            }

        };
        $o->setFormatter($f);
        $report = $o->report();
        $this->assertInstanceOf(MockedReport::class, $report);
        $this->assertInstanceOf(MockedReportable::class, $report->getReportable());
        $this->assertSame($f, $report->getFormatter());
        $str = 'ValueEquals: 2';
        $this->assertEquals($str, (string)$report);
        $formatter = $report->getFormatter();
        $this->assertEquals($str, $formatter->format($report));
        /** @var MockedFormatter $formatter */
        $this->assertEquals(3, $formatter->getOptions());
        $o->setFormatter(MockedFormatter::class, 4);
        $report = $o->report();
        $formatter = $report->getFormatter();
        $str = 'Value: 2';
        $this->assertEquals($str, $formatter->format($report));
        /** @var MockedFormatter $formatter */
        $this->assertEquals(4, $formatter->getOptions());
    }

    /**
     * @test
     * @throws BindingResolutionException
     */
    public function second(): void
    {
        $o =
            new class extends AbstractReportable
            {
            };
        $report = $o->report();
        $this->assertInstanceOf(DefaultReport::class, $report);
        $this->assertSame($o, $report->getReportable());
        $this->assertInstanceOf(DefaultFormatter::class, $report->getFormatter());
        $str = '[AlecRabbit\Formatters\DefaultFormatter]: got AlecRabbit\Reports\DefaultReport';
        $this->assertEquals($str, (string)$report);
    }

    /** @test */
    public function third(): void
    {
        $report = new DefaultReport();
        $this->assertNull($report->getFormatter());
        $str = 'AlecRabbit\Reports\DefaultReport ERROR: no formatter';
        $this->assertEquals($str, (string)$report);
    }

    /** @test */
    public function fours(): void
    {
        $formatter = new DefaultFormatter();
        $report = new class($formatter) extends AbstractReport
        {
        };
        $this->assertSame($formatter, $report->getFormatter());
        $str = '[AlecRabbit\Formatters\DefaultFormatter] ERROR: AlecRabbit\Reports\DefaultReport expected';
        $formatted = $formatter->format($report);
        $this->assertStringContainsString($str, $formatted);
        $this->assertStringContainsString('given.', $formatted);
    }
}
