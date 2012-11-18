<?php

namespace Lifestream\Tests\Filter;

use Lifestream\Filter\Twitter;

class TwitterTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->twitter = new Twitter();
    }

    public function testConfiguration()
    {
        $twitter = new Twitter(0);
        $this->assertFalse($twitter->shouldFilterReply());
        $this->assertFalse($twitter->shouldFilterRetweet());

        $twitter->enableFilterReply();
        $this->assertTrue($twitter->shouldFilterReply());
        $this->assertFalse($twitter->shouldFilterRetweet());

        $twitter->enableFilterRetweet();
        $this->assertTrue($twitter->shouldFilterReply());
        $this->assertTrue($twitter->shouldFilterRetweet());

        $twitter->disabledFilterReply();
        $this->assertFalse($twitter->shouldFilterReply());
        $this->assertTrue($twitter->shouldFilterRetweet());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testConvertStringFlag()
    {
        $this->twitter->enableFilter('foo');
    }

    public function getInvalidateMentionTests()
    {
        return array(
            array(true, ''),
            array(true, 'Hi'),
            array(true, 'Hi @lyrixx'),
            array(false, '@lyrixx'),
            array(false, '@lyrixx Hi'),
        );
    }

    /**
     * @dataProvider getInvalidateMentionTests
     */
    public function testInvalidateMention($expected, $text)
    {
        $status = $this->getMock('Lifestream\StatusInterface');
        $status
            ->expects($this->any())
            ->method('getText')
            ->will($this->returnValue($text))
        ;

        $this->assertSame($expected, $this->twitter->isValid($status));
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
        $status = $this->getMock('Lifestream\StatusInterface');
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
