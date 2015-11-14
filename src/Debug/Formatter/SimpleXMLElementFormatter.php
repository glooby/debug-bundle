<?php

namespace Glooby\Debug\Formatter;

use Glooby\Debug\Exception\FormatterException;

/**
 * @author Emil Kilhage
 */
class SimpleXMLElementFormatter implements FormatterInterface
{
    /**
     * @param \SimpleXMLElement $response
     * @return string
     * @throws FormatterException
     */
    public function format($response)
    {
        $response = $response->asXML();

        if (false === $response) {
            throw FormatterException::unableToFormatMessageException();
        }

        return $response;
    }
}
