<?php

namespace Glooby\Debug\Formatter;

use Glooby\Debug\Exception\FormatterException;
use GuzzleHttp\Message\ResponseInterface;

/**
 * @author Emil Kilhage
 */
class GuzzleResponseFormatter implements  FormatterInterface
{
    /**
     * @param ResponseInterface $response
     * @return string
     * @throws FormatterException
     */
    public function format($response)
    {
        $headers = print_r($response->getHeaders(), true);

        $body = $this->formatBody($response);

        return <<<TXT
Status: {$response->getStatusCode()}

Protocol Version: {$response->getProtocolVersion()}

Reason Phrase: {$response->getReasonPhrase()}

Effective Url: {$response->getEffectiveUrl()}

Headers:
{$headers}

Body:
{$body}

TXT;
    }

    /**
     * @param ResponseInterface $response
     * @return string
     */
    private function formatBody(ResponseInterface $response)
    {
        if ($response->getHeader('Content-Type') === 'application/json') {
            $formatter = new JsonStringFormatter();
            return $formatter->format($response->getBody());
        } elseif ($response->getHeader('Content-Type') === 'application/xml') {
            $formatter = new XmlStringFormatter();
            return $formatter->format($response->getBody());
        }

        return $response->getBody();
    }
}
