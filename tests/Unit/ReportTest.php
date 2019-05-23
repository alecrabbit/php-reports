<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Reports;

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

        $f = new class extends MockedFormatter {
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
        $this->assertEquals($str, $report->getFormatter()->format($report));
    }
}
