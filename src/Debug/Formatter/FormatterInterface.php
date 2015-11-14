<?php

namespace Glooby\Debug\Formatter;

use Glooby\Debug\Exception\FormatterException;

/**
 * @author Emil Kilhage
 */
interface FormatterInterface
{
    /**
     * @param mixed $response
     * @return string
     * @throws FormatterException
     */
    public function format($response);
}
