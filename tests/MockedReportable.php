<?php declare(strict_types=1);

namespace AlecRabbit\Tests;

use AlecRabbit\Reports\Core\AbstractReportable;

class MockedReportable extends AbstractReportable
{
    /** @var int */
    protected $value = 2;

    public function __construct()
    {
        parent::__construct();
        $this->setBindings(
            MockedReport::class,
            MockedFormatter::class
        );
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
