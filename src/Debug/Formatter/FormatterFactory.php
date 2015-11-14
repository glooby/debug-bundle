<?php

namespace Glooby\Debug\Formatter;

use Glooby\Api\FlightBundle\Supplier\Base\ResultSet;
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
        \Exception::class => ExceptionFormatter::class,
        ResponseInterface::class => GuzzleResponseFormatter::class,
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
                    return $this->setup(new $formatterClassName());
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
