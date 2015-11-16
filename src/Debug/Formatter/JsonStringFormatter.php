<?php

namespace Glooby\Debug\Formatter;

/**
 * @author Emil Kilhage
 */
class JsonStringFormatter implements FormatterInterface
{
    /**
     * @var array
     */
    private static $headers = [
        'application/json',
    ];

    /**
     * @param string $header
     * @return bool
     */
    public static function isJsonHeader($header)
    {
        return in_array($header, self::$headers, true);
    }

    /**
     * {@inheritdoc}
     */
    public function format($response)
    {
        $response = \GuzzleHttp\json_decode($response);

        return json_encode($response, JSON_PRETTY_PRINT);
    }
}
