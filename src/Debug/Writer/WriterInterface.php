<?php

namespace Glooby\Debug\Writer;

use Glooby\Debug\Exception\WriterException;

/**
 * @author Emil Kilhage
 */
interface WriterInterface
{
    /**
     * @param string $name
     * @param string $output
     * @throws WriterException
     */
    public function write($name, $output);
}
