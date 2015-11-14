<?php

namespace Glooby\Debug\Writer;

/**
 * @author Emil Kilhage
 */
class NullWriter implements WriterInterface
{
    /**
     * {@inheritdoc}
     */
    public function write($name, $output)
    {
    }
}
