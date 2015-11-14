<?php

namespace Glooby\Debug\Formatter;

/**
 * @author Emil Kilhage
 */
class StringFormatter implements FormatterInterface
{
    /**
     * {@inheritdoc}
     */
    public function format($response)
    {
        return "$response";
    }
}
