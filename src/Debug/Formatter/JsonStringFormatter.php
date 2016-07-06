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
     * @param string $string
     * @return bool
     */
    public static function isJsonString($string)
    {
        $string = trim($string);

        if (substr($string, 0, 1) === '{' && substr($string, -1, 1) === '}') {
            try {
                json_decode($string);
                return json_last_error() === JSON_ERROR_NONE;
            } catch (\Exception $e) {

            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function format($response)
    {
        try {
            $response = \GuzzleHttp\jsonDecode($response);

            return json_encode($response, JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return $response;
        }
    }
}
