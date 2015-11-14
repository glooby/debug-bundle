<?php

namespace Glooby\Debug\Formatter;

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
        $text = "$exception\n";

        $text = $this->addPrevious($exception, $text);

        return $text;
    }

    /**
     * @param \Exception $exception
     * @param string     $text
     * @return string
     */
    private function addPrevious($exception, $text)
    {
        if ($exception->getPrevious() instanceof \Exception) {
            $text .= "\nPrevious:\n----------\n" . $this->format($exception->getPrevious());
            return $text;
        }

        return $text;
    }
}
