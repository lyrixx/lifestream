<?php

namespace Lifestream\Tests\Filter;

use Lifestream\Filter\Twitter;

class TwitterTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->twitter = new Twitter();
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

    public function tearDown()
    {
        $this->twitter = null;
    }
}
