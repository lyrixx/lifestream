<?php

namespace Lyrixx\Lifestream\Tests;

use Lyrixx\Lifestream\Stream;
use Lyrixx\Lifestream\Status;

class StreamTest extends \PHPUnit_Framework_TestCase
{
    public function testCount()
    {
        $status = new Status();

        $stream = new Stream();
        for ($i=0; $i < 10; $i++) {
            $stream->addStatus($status);
        }

        $this->assertCount(10, $stream);
    }

    public function testIterator()
    {
        $status = new Status();
        $statues = array();

        $stream = new Stream();
        for ($i=0; $i < 10; $i++) {
            $statusTmp = clone $status;

            $statues[] = $statusTmp;
            $stream->addStatus($statusTmp);
        }

        foreach ($stream as $k => $status) {
            $this->assertInstanceOf('Lyrixx\Lifestream\Status', $status);
            $this->assertSame($statues[$k], $status);
        }
    }
}
