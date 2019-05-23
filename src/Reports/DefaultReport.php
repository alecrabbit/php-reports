<?php declare(strict_types=1);

namespace AlecRabbit\Reports;

use AlecRabbit\Reports\Contracts\ReportableInterface;
use AlecRabbit\Reports\Contracts\ReportInterface;
use AlecRabbit\Reports\Core\AbstractReport;

class DefaultReport extends AbstractReport
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        // TODO: Implement __toString() method.
    }

}
