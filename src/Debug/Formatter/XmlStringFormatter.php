<?php

namespace Glooby\Debug\Formatter;

use Glooby\Debug\Exception\FormatterException;

/**
 * @author Emil Kilhage
 */
class XmlStringFormatter implements FormatterInterface
{
    /**
     * @var array
     */
    private static $headers = [
        '/^application\/.*xml/',
    ];

    /**
     * @param string $header
     * @return bool
     */
    public static function isXmlHeader($header)
    {
        foreach (self::$headers as $pattern) {
            if (preg_match($pattern, $header)) {
                return true;
            }
        }

        return false;
    }

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
