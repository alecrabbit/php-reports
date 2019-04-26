<?php declare(strict_types=1);

namespace AlecRabbit\Tests;

use AlecRabbit\Formatters\Core\AbstractFormatter;
use AlecRabbit\Formatters\Core\Formattable;

class ExtendsAbstractFormatter extends AbstractFormatter
{
    public const EXPECTED_CLASS_STUB = 'ExpectedClassStub';

    public function format(Formattable $data): string
    {
        return $this->errorMessage($data, self::EXPECTED_CLASS_STUB);
    }
}
