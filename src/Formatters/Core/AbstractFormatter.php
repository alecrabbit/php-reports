<?php declare(strict_types=1);

namespace AlecRabbit\Formatters\Core;

use AlecRabbit\Formatters\Contracts\FormatterInterface;
use AlecRabbit\Reports\Core\Formattable;
use AlecRabbit\Reports\DefaultReport;

abstract class AbstractFormatter implements FormatterInterface
{
    /** @var int */
    protected $options;

    /** {@inheritDoc} */
    public function __construct(?int $options = null)
    {
        $this->options = $options ?? 0;
    }

    /** {@inheritDoc} */
    public function format(Formattable $formattable): string
    {
        if ($formattable instanceof DefaultReport) {
            return
                sprintf(
                    '[%s]: got %s',
                    get_class($this),
                    get_class($formattable)
                );
        }
        return $this->errorMessage($formattable, DefaultReport::class);
    }

    /**
     * @param object $data
     * @param string $class
     * @return string
     */
    protected function errorMessage(object $data, string $class): string
    {
        return
            '[' . get_class($this) . '] ERROR: ' . $class . ' expected, ' . get_class($data) . ' given.';
    }
}
