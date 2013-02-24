<?php

namespace Lyrixx\Lifestream\Tests\Formatter;

use Lyrixx\Lifestream\Status;

abstract class AbstractTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->formatter = $this->createNewFormater();
    }

    abstract public function getFormatTests();

    /**
     * @dataProvider getFormatTests
     */
    public function testFormat($expected, $text)
    {
        $status = new Status();
        $status->setText($text);

        $this->assertSame($expected, $this->formatter->format($status)->getText());
    }

    public function tearDown()
    {
        $this->formatter = null;
    }

    abstract protected function createNewFormater();
}
