<?php declare(strict_types=1);

namespace AlecRabbit\Formatters\Contracts;

use AlecRabbit\Reports\Core\Formattable;

interface FormatterInterface
{
    /**
     * @param int|null $options
     */
    public function __construct(?int $options = null);

    /**
     * @param Formattable $data
     * @return string
     */
    public function format(Formattable $data): string;
}
