<?php declare(strict_types=1);

namespace AlecRabbit\Reports\Core;

use AlecRabbit\Formatters\Contracts\FormatterInterface;
use AlecRabbit\Formatters\Core\AbstractFormatter;
use AlecRabbit\Formatters\DefaultFormatter;
use AlecRabbit\Reports\Contracts\ReportableInterface;
use AlecRabbit\Reports\DefaultReport;
use Illuminate\Contracts\Container\BindingResolutionException;
use function AlecRabbit\container;

abstract class AbstractReportable implements ReportableInterface
{
    /** @var string */
    protected $reportClass;
    /** @var string */
    protected $formatterClass;

    public function __construct()
    {
        $this->setBindings();
    }

    protected function setBindings(string $reportClass = null, string $formatterClass = null): void
    {
        $this->reportClass = $reportClass ?? DefaultReport::class;
        $this->formatterClass = $formatterClass ?? DefaultFormatter::class;
        $this->setReportFormatterDependencies(
            $this->reportClass,
            FormatterInterface::class,
            $this->formatterClass,
            null
        );
    }

    /**
     * @param string $reportClass
     * @param string $formatterClass
     * @param AbstractFormatter|string|\Closure $formatter
     * @param null|int $options
     *
     * @psalm-suppress InvalidScalarArgument
     */
    protected function setReportFormatterDependencies(
        string $reportClass,
        string $formatterClass,
        $formatter,
        ?int $options
    ): void {
        if ($formatter instanceof AbstractFormatter) {
            $formatter = static function () use ($formatter): AbstractFormatter {
                return $formatter;
            };
        }
        container()
            ->when($reportClass)
            ->needs($formatterClass)
            ->give($formatter);
        if (is_string($formatter)) {
            container()
                ->when($formatter)
                ->needs('$options')
                ->give($options);
        }
    }

    /**
     * @param null|AbstractFormatter|string|\Closure $formatter
     * @param null|int $options
     */
    public function setFormatter($formatter = null, ?int $options = null): void
    {
        /** @noinspection ProperNullCoalescingOperatorUsageInspection */
        $formatter = $formatter ?? $this->formatterClass;

        $this->setReportFormatterDependencies(
            $this->reportClass,
            FormatterInterface::class,
            $formatter,
            $options
        );
    }

    /**
     * @noinspection ReturnTypeCanBeDeclaredInspection
     *
     * @return AbstractReport
     * @throws BindingResolutionException
     *
     */
    public function report(): AbstractReport
    {
        return container()->make($this->reportClass, ['reportable' => $this]);
    }
}
