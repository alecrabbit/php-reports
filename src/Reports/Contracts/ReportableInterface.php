<?php declare(strict_types=1);

namespace AlecRabbit\Reports\Contracts;

use AlecRabbit\Reports\Core\AbstractReport;

interface ReportableInterface
{
    /**
     * @return AbstractReport
     */
    public function report(): AbstractReport;
}
