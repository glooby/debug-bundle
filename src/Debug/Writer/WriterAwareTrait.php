<?php

namespace Glooby\Debug\Writer;

/**
 * @author Emil Kilhage
 */
trait WriterAwareTrait
{
    /**
     * @var WriterInterface
     */
    protected $writer;

    /**
     * @param WriterInterface $writer
     */
    public function setWriter(WriterInterface $writer)
    {
        $this->writer = $writer;
    }
}
