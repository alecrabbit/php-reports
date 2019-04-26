<?php declare(strict_types=1);

namespace AlecRabbit\Tests;

use PHPUnit\Framework\TestCase;

class ReportableTest extends TestCase
{
    /** @var ExtendsReportable */
    private $obj;

    /** @test */
    public function check(): void
    {
        $report = $this->obj->report();
        $this->assertInstanceOf(ExtendsReportableReport::class, $report);
        $this->assertStringContainsString(ExtendsReportableReport::REPORT_HAS_BEEN_BUILT, (string)$report);
    }

    /** @test */
    public function reportAlreadyInitialized(): void
    {
        $obj = new class extends ExtendsReportable {
            public function __construct()
            {
                // parent::__construct(); // not called intentionally
                $this->report = null;
            }

        };
        $report = $obj->report();
        $this->assertInstanceOf(ExtendsReportableReport::class, $report);
        $this->assertStringContainsString(ExtendsReportableReport::REPORT_HAS_BEEN_BUILT, (string)$report);
    }

    protected function setUp(): void
    {
        $this->obj = new ExtendsReportable();
    }
}
