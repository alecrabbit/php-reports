<?php declare(strict_types=1);

namespace AlecRabbit\Tests;

use AlecRabbit\Reports\Core\AbstractReport;
use AlecRabbit\Reports\Core\AbstractReportable;

class MockedReport extends AbstractReport
{
    /** {@inheritDoc} */
    protected function extractDataFrom(AbstractReportable $reportable = null): void
    {
        $this->data = [];
        if ($reportable instanceof MockedReportable) {
            $this->data['value'] = $reportable->getValue();
        }
    }
}
