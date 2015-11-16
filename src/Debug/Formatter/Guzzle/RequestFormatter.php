<?php

namespace Glooby\Debug\Formatter\Guzzle;

use Glooby\Debug\Exception\FormatterException;
use Glooby\Debug\Formatter\FormatterHelper;
use GuzzleHttp\Message\RequestInterface;

/**
 * @author Emil Kilhage
 */
class RequestFormatter extends AbstractMessageFormatter
{
    /**
     * @param RequestInterface $request
     * @return string
     * @throws FormatterException
     */
    public function format($request)
    {
        $body = $this->formatBody($request);

        $sections = [
            'Request Method' => $request->getMethod(),
            'Request Url' => $request->getUrl(),
            'Request Port' => $request->getPort(),
            'Request Headers' => [],
            'Request Body' => $body,
        ];

        $sections['Request Headers'] = $this->formatHeaders($request);

        $message = FormatterHelper::formatSections($sections);

        return $message;
    }
}
