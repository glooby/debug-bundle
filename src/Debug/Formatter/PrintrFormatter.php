<?php

namespace Glooby\Debug\Formatter;

/**
 * @author Emil Kilhage
 */
class PrintrFormatter implements FormatterInterface
{
    /**
     * {@inheritdoc}
     */
    public function format($response)
    {
        return print_r($response, true);
    }
}
