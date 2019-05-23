<?php declare(strict_types=1);

namespace AlecRabbit\Formatters\Core;

use AlecRabbit\Formatters\Contracts\FormatterInterface;

abstract class AbstractFormatter implements FormatterInterface
{
    /** @var int */
    protected $options = 0;

    /** {@inheritDoc} */
    public function __construct(?int $options = null)
    {
        $this->options = $options ?? 0;
    }

    /** {@inheritDoc} */
    abstract public function format(Formattable $data): string;

    /**
     * @param object $data
     * @param string $class
     * @return string
     */
    protected function errorMessage(object $data, string $class): string
    {
        return
            $class . ' expected, ' . get_class($data) . ' given.';
    }
}
