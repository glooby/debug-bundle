<?php

namespace Glooby\Debug\Dumper;

/**
 * @author Emil Kilhage
 */
trait DumperAwareTrait
{
    /**
     * @var DumperInterface
     */
    protected $dumper;

    /**
     * @param DumperInterface $dumper
     */
    public function setDumper(DumperInterface $dumper)
    {
        $this->dumper = $dumper;
    }
}
