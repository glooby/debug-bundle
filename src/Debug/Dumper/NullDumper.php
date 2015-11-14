<?php

namespace Glooby\Debug\Dumper;

/**
 * @author Emil Kilhage
 */
class NullDumper implements DumperInterface
{

    /**
     * {@inheritdoc}
     */
    public function dump($id, $output, $ext = 'txt')
    {
    }
}
