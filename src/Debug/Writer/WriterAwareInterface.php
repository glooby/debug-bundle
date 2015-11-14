<?php

namespace Glooby\Debug\Writer;

/**
 * @author Emil Kilhage
 */
interface WriterAwareInterface
{
    /**
     * @param WriterInterface $writer
     */
    public function setWriter(WriterInterface $writer);
}
