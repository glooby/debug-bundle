<?php

namespace Glooby\Debug\Formatter;

/**
 * @author Emil Kilhage
 */
trait FormatterAwareTrait
{
    /**
     * @var FormatterInterface
     */
    private $formatter;

    /**
     * @param FormatterInterface $formatter
     */
    public function setFormatter(FormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }
}
