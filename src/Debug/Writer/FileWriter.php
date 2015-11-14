<?php

namespace Glooby\Debug\Writer;

use Glooby\Debug\Exception\WriterException;

/**
 * @author Emil Kilhage
 */
class FileWriter implements WriterInterface
{
    /**
     * @var string
     */
    private $directory;

    /**
     * @param string $directory
     */
    public function setDirectory($directory)
    {
        $this->directory = $directory;
    }

    /**
     * {@inheritdoc}
     */
    public function write($name, $output)
    {
        $filePath = sprintf('%s/%s', $this->directory, $name);

        if (file_exists($filePath)) {
            throw WriterException::fileExistException($filePath);
        }

        $result = file_put_contents($filePath, $output);

        if (false === $result) {
            throw WriterException::writeFailureException($filePath);
        }
    }
}
