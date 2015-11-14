<?php

namespace Glooby\Debug\Formatter;

use Glooby\Debug\Exception\FormatterException;

/**
 * @author Emil Kilhage
 */
class XmlStringFormatter implements  FormatterInterface
{
    /**
     * @param string $xml
     * @return string
     * @throws FormatterException
     */
    public function format($xml)
    {
        $dom = new \DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml);
        return $dom->saveXML();
    }
}
