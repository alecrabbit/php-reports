<?php declare(strict_types=1);

namespace AlecRabbit\Tests;

use AlecRabbit\Formatters\Core\AbstractFormatter;
use AlecRabbit\Reports\Core\Formattable;

class MockedFormatter extends AbstractFormatter
{
    public function format(Formattable $formattable): string
    {
        if ($formattable instanceof MockedReport) {
            $data = $formattable->getData();
            return
                $this->simple($data);
        }
        return
            $this->errorMessage($formattable, MockedReport::class);
    }

    protected function simple(array $data): string
    {
        return
            sprintf(
                'Value: %s',
                $data['value']
            );
    }
}
