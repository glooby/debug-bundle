<?php

namespace Glooby\Debug\Exception;

/**
 * @author Emil Kilhage
 */
class FormatterException extends Exception
{
    /**
     * @return FormatterException
     */
    public static function unableToFormatMessageException()
    {
        return new self('unable to format message');
    }
}
