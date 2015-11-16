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
     * @param string $string
     * @return bool
     */
    public static function isXmlString($string)
    {
        $string = trim($string);

        if (substr($string, 0, 1) === '<' && substr($string, -1, 1) === '>') {
            try {
                $dom = new \DOMDocument('1.0');
                $dom->validateOnParse = true;
                return $dom->loadXML($string) !== false;
            } catch (\Exception $e) {

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
        try {
            $dom = new \DOMDocument('1.0');
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            $dom->validateOnParse = true;
            $dom->loadXML($xml);
            return $dom->saveXML();
        } catch (\Exception $e) {
            return $xml;
        }
    }
}
