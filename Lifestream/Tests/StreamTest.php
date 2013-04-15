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
        $stream = new Stream();
        for ($i=0; $i < 10; $i++) {
            $status = new Status();
            $status->setText($i);

            $stream->addStatus($status);
        }

        foreach ($stream as $k => $status) {
            $this->assertInstanceOf('Lyrixx\Lifestream\Status', $status);
            $this->assertSame($k, $status->getText());
        }
    }
}
