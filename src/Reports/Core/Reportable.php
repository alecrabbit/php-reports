<?php declare(strict_types=1);

namespace AlecRabbit\Reports\Core;

use AlecRabbit\Reports\Contracts\ReportableInterface;
use AlecRabbit\Reports\Contracts\ReportInterface;

abstract class Reportable implements ReportableInterface
{
    /** @var ReportInterface */
    protected $report;

    public function __construct()
    {
        $this->report = $this->createEmptyReport();
    }

    /**
     * @param bool $rebuild Rebuild report object
     * @return ReportInterface
     */
    public function report(bool $rebuild = true): ReportInterface
    {
        $rebuild = $this->checkReport() || $rebuild;
        if (true === $rebuild) {
            $this->checkConditions();
            $this->beforeReport();
            /** @noinspection PhpParamsInspection */
            $this->report->buildOn($this);
        }
        return
            $this->report;
    }

    /**
     * Checks if all conditions needed for report are met
     */
    protected function checkConditions(): void
    {
    }

    /**
     * Makes all necessary actions before report
     */
    protected function beforeReport(): void
    {
    }

    abstract protected function createEmptyReport(): ReportInterface;

    /**
     * @return bool
     */
    protected function checkReport(): bool
    {
        if (null === $this->report) {
            $this->report = $this->createEmptyReport();
            return true;
        }
        return false;
    }
}
