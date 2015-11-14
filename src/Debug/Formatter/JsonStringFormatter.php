<?php

namespace Glooby\Debug\Formatter;

/**
 * @author Emil Kilhage
 */
class JsonStringFormatter implements  FormatterInterface
{
    /**
     * {@inheritdoc}
     */
    public function format($response)
    {
        $response = \GuzzleHttp\json_decode($response);

        return json_encode($response, JSON_PRETTY_PRINT);
    }
}
