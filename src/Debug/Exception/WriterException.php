<?php

namespace Glooby\Debug\Exception;

/**
 * @author Emil Kilhage
 */
class WriterException extends Exception
{
    /**
     * @param string $filePath
     * @return WriterException
     */
    public static function fileExistException($filePath)
    {
        return new self("file already exist: $filePath");
    }

    /**
     * @param string $filePath
     * @return WriterException
     */
    public static function writeFailureException($filePath)
    {
        return new self("unable to write to file: $filePath");
    }
}
