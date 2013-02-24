<?php

namespace Lyrixx\Lifestream\Tests\Filter;

use Lyrixx\Lifestream\Filter\TwitterRetweet;

class TwitterRetweetTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->twitter = new TwitterRetweet();
    }

    public function getInvalidateRetweetTests()
    {
        return array(
            array(true, ''),
            array(true, 'Hi'),
            array(true, 'Hi @lyrixx RT @lyrixx'),
            array(false, 'RT @lyrixx'),
            array(false, 'RT @lyrixx Hi'),
        );
    }

    /**
     * @dataProvider getInvalidateRetweetTests
     */
    public function testInvalidateRetweet($expected, $text)
    {
        $status = $this->getMock('Lyrixx\Lifestream\StatusInterface');
        $status
            ->expects($this->any())
            ->method('getText')
            ->will($this->returnValue($text))
        ;

        $this->assertSame($expected, $this->twitter->isValid($status));
    }

    public function tearDown()
    {
        $this->twitter = null;
    }
}
