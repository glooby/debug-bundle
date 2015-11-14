<?php

namespace Glooby\Debug\Formatter;

/**
 * @author Emil Kilhage
 */
class Formatter implements FormatterInterface
{
    /**
     * @var FormatterFactoryInterface
     */
    private $formatterFactory;

    /**
     * @param FormatterFactoryInterface $formatterFactory
     */
    public function setFormatterFactory($formatterFactory)
    {
        $this->formatterFactory = $formatterFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function format($response)
    {
        return $this->formatterFactory->factory($response)->format($response);
    }
}
