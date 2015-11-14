<?php

namespace Glooby\Debug\Tests\Dumper;
use Glooby\Debug\Dumper\Dumper;
use Glooby\Debug\Formatter\FormatterInterface;
use Glooby\Debug\Writer\WriterInterface;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophet;

/**
 * @author Emil Kilhage
 */
class DumperTestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Dumper
     */
    private $dumper;

    /**
     * @var ObjectProphecy
     */
    private $formatter;

    /**
     * @var ObjectProphecy
     */
    private $writer;

    /**
     * @var Prophet
     */
    private $prophet;

    /**
     *
     */
    protected function setUp()
    {
        $prophet = new Prophet();
        $this->prophet = $prophet;

        $this->formatter = $this->prophet->prophesize(FormatterInterface::class);
        $this->writer = $this->prophet->prophesize(WriterInterface::class);

        $this->dumper = new Dumper();
        $this->dumper->setFormatter($this->formatter->reveal());
        $this->dumper->setWriter($this->writer->reveal());
    }

    /**
     *
     */
    protected function tearDown()
    {
        $this->prophet->checkPredictions();
    }

    /**
     *
     */
    public function testDefaultDisabled()
    {
        $this->formatter->format(Argument::any())->shouldNotBeCalled();
        $this->writer->write(Argument::any())->shouldNotBeCalled();

        $this->dumper->dump('id', ['test' => 1]);
    }

    /**
     *
     */
    public function testWrites()
    {
        $this->formatter->format(Argument::any())->shouldBeCalledTimes(1);
        $this->writer->write(Argument::any(), Argument::any())->shouldBeCalledTimes(1);

        $this->dumper->setEnabled(true);
        $this->dumper->dump('id', ['test' => 1]);
    }
}
