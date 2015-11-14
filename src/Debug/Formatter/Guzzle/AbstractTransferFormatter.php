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
abstract class AbstractTransferFormatter implements  FormatterInterface
{
    /**
     * @param RequestInterface|ResponseInterface $request
     * @return string
     */
    protected function formatBody($request)
    {
        if ($request->getHeader('Content-Type') === 'application/json') {
            $formatter = new JsonStringFormatter();
            return $formatter->format($request->getBody());
        } elseif ($request->getHeader('Content-Type') === 'application/xml') {
            $formatter = new XmlStringFormatter();
            return $formatter->format($request->getBody());
        }

        return $request->getBody();
    }

    /**
     * @param RequestInterface|ResponseInterface $request
     * @return string
     */
    protected function formatHeaders($request)
    {
        $headers = [];

        foreach ($request->getHeaders() as $header => $value) {
            $headers[] = sprintf('%s: %s', $header, implode("\n  : ", $value));
        }

        return implode("\n", $headers);
    }
}