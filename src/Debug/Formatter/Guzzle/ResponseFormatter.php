<?php

namespace Glooby\Debug\Formatter\Guzzle;

use Glooby\Debug\Exception\FormatterException;
use Glooby\Debug\Formatter\FormatterHelper;
use GuzzleHttp\Message\ResponseInterface;

/**
 * @author Emil Kilhage
 */
class ResponseFormatter extends AbstractTransferFormatter
{
    /**
     * @param ResponseInterface $response
     * @return string
     * @throws FormatterException
     */
    public function format($response)
    {
        $body = $this->formatBody($response);

        $sections = [
            'Response Status Code' => $response->getStatusCode(),
            'Response Protocol Version' => $response->getProtocolVersion(),
            'Response Reason Phrase' => $response->getReasonPhrase(),
            'Response Effective Url' => $response->getEffectiveUrl(),
            'Response Headers' => [],
            'Response Body' => $body,
        ];

        $sections['Response Headers'] = $this->formatHeaders($response);

        $message = FormatterHelper::formatSections($sections);

        return $message;
    }
}
