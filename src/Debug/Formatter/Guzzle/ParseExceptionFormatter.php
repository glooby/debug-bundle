<?php

namespace Glooby\Debug\Formatter\Guzzle;

use Glooby\Debug\Exception\FormatterException;
use Glooby\Debug\Formatter\ExceptionFormatter;
use Glooby\Debug\Formatter\FormatterInterface;
use GuzzleHttp\Exception\ParseException;

/**
 * @author Emil Kilhage
 */
class ParseExceptionFormatter implements  FormatterInterface
{
    /**
     * @param ParseException $response
     * @return string
     * @throws FormatterException
     */
    public function format($response)
    {
        $exceptionFormatter = new ExceptionFormatter();

        if (null !== $response->getResponse()) {
            $formatter = new ResponseFormatter();
            $message = $formatter->format($response->getResponse());

            if ($response instanceof \Exception) {
                $message = <<<TXT
{$exceptionFormatter->format($response)}

$message
TXT;
            }

            return $message;
        } else {
            return $exceptionFormatter->format($response);
        }
    }
}
