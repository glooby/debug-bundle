<?php

namespace Glooby\Debug\Formatter\Guzzle;

use Glooby\Debug\Formatter\FormatterInterface;
use Glooby\Debug\Formatter\JsonStringFormatter;
use Glooby\Debug\Formatter\XmlStringFormatter;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;

/**
 * @author Emil Kilhage
 */
abstract class AbstractMessageFormatter implements  FormatterInterface
{
    /**
     * @param RequestInterface|ResponseInterface $message
     * @return string
     */
    protected function formatBody($message)
    {
        $header = $message->getHeader('Content-Type');

        if (JsonStringFormatter::isJsonHeader($header)) {
            $formatter = new JsonStringFormatter();
            return $formatter->format($message->getBody());
        } elseif (XmlStringFormatter::isXmlHeader($header)) {
            $formatter = new XmlStringFormatter();
            return $formatter->format($message->getBody());
        }

        return $message->getBody();
    }

    /**
     * @param RequestInterface|ResponseInterface $message
     * @return string
     */
    protected function formatHeaders($message)
    {
        $headers = [];

        foreach ($message->getHeaders() as $header => $value) {
            $headers[] = sprintf('%s: %s', $header, implode("\n  : ", $value));
        }

        return implode("\n", $headers);
    }
}
