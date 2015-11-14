<?php

namespace Glooby\Debug\Dumper;

/**
 * @author Emil Kilhage
 */
interface DumperAwareInterface
{
    /**
     * @param DumperInterface $dumper
     */
    public function setDumper(DumperInterface $dumper);
}
