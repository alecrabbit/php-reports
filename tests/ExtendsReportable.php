<?php declare(strict_types=1);

namespace AlecRabbit\Tests;

use AlecRabbit\Reports\Core\Reportable;
use AlecRabbit\Reports\Contracts\ReportInterface;

class ExtendsReportable extends Reportable
{
    protected function createEmptyReport(): ReportInterface
    {
        return new ExtendsReportableReport();
    }
}
