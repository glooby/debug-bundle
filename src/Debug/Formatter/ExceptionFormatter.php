<?php

namespace Glooby\Debug\Formatter;

/**
 * @author Emil Kilhage
 */
class ExceptionFormatter implements FormatterInterface
{
    /**
     * @param \Exception $exception
     * @return string
     */
    public function format($exception)
    {
        $text = "$exception\n";

        return $text;
    }
}
