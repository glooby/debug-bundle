<?php

namespace Glooby\Debug\Formatter\Guzzle;

use Glooby\Debug\Exception\FormatterException;
use Glooby\Debug\Formatter\ExceptionFormatter;
use Glooby\Debug\Formatter\FormatterInterface;
use Glooby\Debug\Formatter\JsonStringFormatter;
use Glooby\Debug\Formatter\XmlStringFormatter;
use GuzzleHttp\Message\ResponseInterface;

/**
 * @author Emil Kilhage
 */
class ResponseFormatter implements  FormatterInterface
{
    /**
     * @param ResponseInterface $response
     * @return string
     * @throws FormatterException
     */
    public function format($response)
    {
        $exceptionFormatter = new ExceptionFormatter();

        $headers = print_r($response->getHeaders(), true);

        $body = $this->formatBody($response);

        $message = <<<TXT
Status: {$response->getStatusCode()}

Protocol Version: {$response->getProtocolVersion()}

Reason Phrase: {$response->getReasonPhrase()}

Effective Url: {$response->getEffectiveUrl()}

Headers:
{$headers}

Body:
{$body}

TXT;
        if ($response instanceof \Exception) {
            $message = <<<TXT
{$exceptionFormatter->format($response)}

$message
TXT;

            return $message;
        }
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
