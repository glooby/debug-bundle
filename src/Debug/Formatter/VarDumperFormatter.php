<?php

namespace Glooby\Debug\Formatter;

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;

/**
 * @author Emil Kilhage
 */
class VarDumperFormatter implements FormatterInterface
{
    /**
     * {@inheritdoc}
     */
    public function format($response)
    {
        $temp = tmpfile();
        $cloner = new VarCloner();
        $dumper = new CliDumper($temp);
        $dumper->dump($cloner->cloneVar($response));
        fseek($temp, 0);
        $response = stream_get_contents($temp);
        fclose($temp);
        return $response;
    }
}
