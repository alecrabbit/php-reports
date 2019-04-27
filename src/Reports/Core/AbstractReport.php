<?php declare(strict_types=1);

namespace AlecRabbit\Reports\Core;

use AlecRabbit\Formatters\Core\Formattable;
use AlecRabbit\Reports\Contracts\ReportInterface;

abstract class AbstractReport extends Formattable implements ReportInterface
{
}
