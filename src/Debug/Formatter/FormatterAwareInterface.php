<?php

namespace Glooby\Debug\Formatter;


/**
 * @author Emil Kilhage
 */
interface FormatterAwareInterface
{
    /**
     * @param FormatterInterface $formatter
     */
    public function setFormatter(FormatterInterface $formatter);
}