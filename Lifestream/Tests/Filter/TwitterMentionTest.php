<?php

namespace Lyrixx\Lifestream\Tests\Filter;

use Lyrixx\Lifestream\Filter\TwitterMention;

class TwitterTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->twitter = new TwitterMention();
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
