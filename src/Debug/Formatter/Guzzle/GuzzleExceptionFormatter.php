<?php

namespace Glooby\Debug\Formatter\Guzzle;

use Glooby\Debug\Exception\FormatterException;
use Glooby\Debug\Formatter\ExceptionFormatter;
use Glooby\Debug\Formatter\FormatterInterface;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;

/**
 * @author Emil Kilhage
 */
class GuzzleExceptionFormatter implements  FormatterInterface
{
    /**
     * @param TransferException $exception
     * @return string
     * @throws FormatterException
     */
    public function format($exception)
    {
        $sections = $this->buildSections($exception);

        return implode("\n\n", $sections);
    }

    /**
     * @param TransferException $exception
     * @return array
     */
    private function buildSections($exception)
    {
        $sections = [];

        if ($exception instanceof \Exception) {
            $formatter = new ExceptionFormatter();
            $sections['Exception'] = $formatter->format($exception);
        }

        if (method_exists($exception, 'getRequest') && $exception->getRequest() instanceof RequestInterface) {
            $formatter = new RequestFormatter();
            $sections['Request'] = $formatter->format($exception->getRequest());
        }

        if (method_exists($exception, 'getResponse') && $exception->getResponse() instanceof ResponseInterface) {
            $formatter = new ResponseFormatter();
            $sections['Response'] = $formatter->format($exception->getResponse());
        }

        return $sections;
    }
}
