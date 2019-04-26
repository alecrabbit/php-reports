<?php declare(strict_types=1);

namespace AlecRabbit\Reports\Contracts;

interface ReportInterface
{
    /**
     * @return string
     */
    public function __toString(): string;

    /**
     * @param ReportableInterface $reportable
     * @return ReportInterface
     */
    public function buildOn(ReportableInterface $reportable): ReportInterface;
}
