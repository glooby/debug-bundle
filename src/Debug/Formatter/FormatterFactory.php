<?php

namespace Glooby\Debug\Formatter;

use Glooby\Api\FlightBundle\Supplier\Base\ResultSet;
use GuzzleHttp\Exception\ParseException;
use GuzzleHttp\Message\ResponseInterface;

/**
 * @author Emil Kilhage
 */
class FormatterFactory implements FormatterFactoryInterface
{
    /**
     * @var string
     */
    private static $defaultFormatter = PrintrFormatter::class;

    /**
     * @param string $defaultFormatter
     */
    public static function setDefaultFormatter($defaultFormatter)
    {
        self::$defaultFormatter = $defaultFormatter;
    }

    /**
     * @var array
     */
    private static $classMap = [
        \SimpleXMLElement::class => SimpleXMLElementFormatter::class,
        ResponseInterface::class => Guzzle\ResponseFormatter::class,
        ParseException::class => Guzzle\ParseExceptionFormatter::class,
        \Exception::class => ExceptionFormatter::class,
    ];

    /**
     * {@inheritdoc}
     */
    public function factory($output)
    {
        if (is_string($output) || is_int($output)) {
            return $this->setup(StringFormatter::class);
        } elseif (is_object($output)) {
            foreach (self::$classMap as $className => $formatterClassName) {
                if (is_a($output, $className)) {
                    return $this->setup($formatterClassName);
                }
            }
        }

        return $this->setup(self::$defaultFormatter);
    }

    /**
     * @param string $className
     * @return FormatterInterface
     */
    private function setup($className)
    {
        $formatter = new $className();
        return $formatter;
    }
}
