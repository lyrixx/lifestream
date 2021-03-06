<?php

namespace Lyrixx\Lifestream\Tests\Filter;

use Lyrixx\Lifestream\Status;

abstract class AbstractTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->filter = $this->createNewFilter();
    }

    abstract public function getFilterTests();

    /**
     * @dataProvider getFilterTests
     */
    public function testFilter($expected, $text)
    {
        $status = new Status();
        $status->setText($text);

        $this->assertSame($expected, $this->filter->isValid($status));
    }

    public function tearDown()
    {
        $this->filter = null;
    }

    abstract protected function createNewFilter();
}
