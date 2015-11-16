<?php

namespace Glooby\Debug\Formatter;
use Glooby\Debug\Exception\FormatterException;

/**
 * @author Emil Kilhage
 */
class StringFactoryFormatter implements FormatterInterface
{
    /**
     * @param string $string
     * @return FormatterInterface
     */
    public static function factory($string)
    {
        $className = self::factoryClassName($string);
        return new $className();
    }

    /**
     * @param string $string
     * @return FormatterInterface
     */
    public static function factoryClassName($string)
    {
        if (JsonStringFormatter::isJsonString($string)) {
            return JsonStringFormatter::class;
        } elseif (XmlStringFormatter::isXmlString($string)) {
            return XmlStringFormatter::class;
        } else {
            return StringFormatter::class;
        }
    }

    /**
     * @param mixed $response
     * @return string
     * @throws FormatterException
     */
    public function format($response)
    {
        return self::factory($response)->format($response);
    }
}
