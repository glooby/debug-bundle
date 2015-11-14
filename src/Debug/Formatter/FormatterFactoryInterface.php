<?php

namespace Glooby\Debug\Formatter;

/**
 * @author Emil Kilhage
 */
interface FormatterFactoryInterface
{
    /**
     * @param mixed $output
     * @return FormatterInterface
     */
    public function factory($output);
}
