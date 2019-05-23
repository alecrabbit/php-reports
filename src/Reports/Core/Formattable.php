<?php declare(strict_types=1);

namespace AlecRabbit\Reports\Core;

use AlecRabbit\Formatters\Contracts\FormatterInterface;

abstract class Formattable
{
    /** @var null|FormatterInterface */
    protected $formatter;

    public function __construct(FormatterInterface $formatter = null)
    {
        $this->formatter = $formatter;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        if ($this->formatter instanceof FormatterInterface) {
            return $this->formatter->format($this);
        }
        return get_class($this) . ' ERROR: no formatter';
    }

    /**
     * @return null|FormatterInterface
     */
    public function getFormatter(): ?FormatterInterface
    {
        return $this->formatter;
    }
}
