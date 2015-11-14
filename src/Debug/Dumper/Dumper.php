<?php

namespace Glooby\Debug\Dumper;

use Glooby\Debug\Formatter\FormatterInterface;
use Glooby\Debug\Writer\WriterInterface;

/**
 * @author Emil Kilhage
 */
class Dumper implements DumperInterface
{
    /**
     * @var FormatterInterface
     */
    private $formatter;

    /**
     * @var WriterInterface
     */
    private $writer;

    /**
     * @var bool
     */
    private $enabled = false;

    /**
     * @param boolean $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @param FormatterInterface $formatter
     */
    public function setFormatter($formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * @param WriterInterface $writer
     */
    public function setWriter($writer)
    {
        $this->writer = $writer;
    }

    /**
     * {@inheritdoc}
     */
    public function dump($id, $output, $ext = 'txt')
    {
        if ($this->enabled === false) {
            return;
        }

        $output = $this->formatter->format($output);

        $name = $this->createName($id, $ext);

        $this->writer->write($name, $output);
    }

    /**
     * @param string $id
     * @param string $ext
     * @return string
     */
    private function createName($id, $ext)
    {
        return sprintf('%s.%s.%s.%s', $id, date('ymd-His'), posix_getpid(), $ext);
    }
}
