<?php declare(strict_types=1);

namespace AlecRabbit;

use Illuminate\Container\Container;

if (!function_exists(__NAMESPACE__ . '\container')) {
    /**
     * @return Container
     */
    function container()
    {
        return
            Container::getInstance();
    }
}
