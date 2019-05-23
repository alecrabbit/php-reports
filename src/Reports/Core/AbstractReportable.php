<?php declare(strict_types=1);

namespace AlecRabbit\Reports\Core;

use AlecRabbit\Formatters\Contracts\FormatterInterface;
use AlecRabbit\Formatters\Core\AbstractFormatter;
use AlecRabbit\Formatters\DefaultFormatter;
use AlecRabbit\Reports\Contracts\ReportableInterface;
use AlecRabbit\Reports\DefaultReport;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;

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

    /**
     * @param AbstractFormatter|string|\Closure $formatter
     */
    public function setFormatter($formatter): void
    {
        $this->setReportFormatterDependencies($this->reportClass, FormatterInterface::class, $formatter);
    }

    protected function setBindings(string $reportClass = null, string $formatterClass = null): void
    {
        $this->reportClass = $reportClass ?? DefaultReport::class;
        $this->formatterClass = $formatterClass ?? DefaultFormatter::class;
        $this->setReportFormatterDependencies(
            $this->reportClass,
            FormatterInterface::class,
            $this->formatterClass
        );
    }

    /**
     * @param string $reportClass
     * @param string $formatterClass
     * @param AbstractFormatter|string|\Closure $formatter
     */
    protected function setReportFormatterDependencies(string $reportClass, string $formatterClass, $formatter): void
    {
        if ($formatter instanceof AbstractFormatter) {
            $formatter = static function () use ($formatter): AbstractFormatter {
                return $formatter;
            };
        }
        Container::getInstance()
            ->when($reportClass)
            ->needs($formatterClass)
            ->give($formatter);
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
        return Container::getInstance()->make($this->reportClass, ['reportable' => $this]);
    }
}
