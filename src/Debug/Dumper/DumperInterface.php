<?php

namespace Glooby\Debug\Dumper;

/**
 * @author Emil Kilhage
 */
interface DumperInterface
{
    /**
     * @param string $id
     * @param mixed  $output
     * @param string $ext
     */
    public function dump($id, $output, $ext = 'txt');
}
