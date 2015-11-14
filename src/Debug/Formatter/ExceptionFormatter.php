<?php

namespace Glooby\Debug\Formatter;

use GuzzleHttp\Exception\RequestException;

/**
 * @author Emil Kilhage
 */
class ExceptionFormatter implements FormatterInterface
{
    /**
     * @param \Exception $exception
     * @return string
     */
    public function format($exception)
    {
        $sections = [
            'Exception' => sprintf('(%s) %s', get_class($exception), $exception->getMessage()),
            'Trace' => $exception->getTraceAsString(),
        ];

        if ($exception instanceof RequestException) {
            $sections = $this->addGuzzleRequestExceptionSections($exception, $sections);
        }

        $sectionsFormatted = [];

        foreach ($sections as $k => $v) {
            $sectionsFormatted[] = sprintf("%s\n%s\n\n%s", $k, str_repeat('-', strlen($k)), trim($v));
        }

        $text = implode("\n\n", $sectionsFormatted)."\n\n";

        return $text;
    }

    /**
     * @param RequestException $exception
     * @param array $sections
     * @return array
     */
    private function addGuzzleRequestExceptionSections(RequestException $exception, array $sections)
    {
        $request = $exception->getRequest();
        $response = $exception->getResponse();

        if ($request) {
            $requestHeaders = [
                $request->getMethod() . ' ' . $request->getUrl(),
            ];

            foreach ($request->getHeaders() as $header => $value) {
                $requestHeaders[] = sprintf('%s: %s', $header, implode("\n  : ", $value));
            }

            $sections['Request headers'] = implode("\n", $requestHeaders);
            $sections['Request body'] = (string)$request->getBody();
        }

        if ($response) {
            $responseHeaders = [
                'Status' => $response->getStatusCode(),
                'Reason' => $response->getReasonPhrase(),
                'Effective URL' => $response->getEffectiveUrl(),
            ];

            foreach ($response->getHeaders() as $header => $value) {
                $responseHeaders[] = sprintf('%s: %s', $header, var_export($value, true));
            }

            $sections['Response headers'] = implode("\n", $responseHeaders);
            $sections['Response body'] = (string)$response->getBody();
        }

        return $sections;
    }

}
