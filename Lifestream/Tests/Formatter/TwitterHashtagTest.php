<?php

namespace Lyrixx\Lifestream\Tests\Formatter;

use Lyrixx\Lifestream\Formatter\TwitterHashtag;
use Lyrixx\Lifestream\Status;

class TwitterHashtagTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->link = new TwitterHashtag();
    }

    public function getFormatTests()
    {
        return array(
            array('', ''),
            array('foo', 'foo'),
            array('<a href="https://twitter.com/search?q=%23lyrixx">#lyrixx</a>', '#lyrixx'),
            array('foo <a href="https://twitter.com/search?q=%23lyrixx">#lyrixx</a>', 'foo #lyrixx'),
            array('<a href="https://twitter.com/search?q=%23lyrixx">#lyrixx</a> foo', '#lyrixx foo'),
            array('foo <a href="https://twitter.com/search?q=%23lyrixx">#lyrixx</a> bar <a href="https://twitter.com/search?q=%23greg">#greg</a> baz', 'foo #lyrixx bar #greg baz'),
            array('<a href="https://twitter.com/search?q=%23h4t4g">#h4t4g</a>', '#h4t4g'),
        );
    }

    /**
     * @dataProvider getFormatTests
     */
    public function testFormat($expected, $text)
    {
        $status = new Status();
        $status->setText($text);

        $this->assertSame($expected, $this->link->format($status)->getText());
    }

    public function tearDown()
    {
        $this->link = null;
    }
}
