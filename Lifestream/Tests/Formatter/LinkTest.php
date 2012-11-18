<?php

namespace Lyrixx\Lifestream\Tests\Formatter;

use Lyrixx\Lifestream\Formatter\Link;
use Lyrixx\Lifestream\Status;

class LinkTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->link = new Link();
    }

    public function getFormatHttpLinkTests()
    {
        return array(
            array('', ''),
            array('foo', 'foo'),
            array('google.com', 'google.com'),
            array('www.google.com', 'www.google.com'),
            array('<a href="http://www.google.com">www.google.com</a>', 'http://www.google.com'),
            array('foo <a href="http://www.google.com">www.google.com</a>', 'foo http://www.google.com'),
            array('<a href="http://www.google.com">www.google.com</a> bar', 'http://www.google.com bar'),
            array('foo <a href="http://www.google.com">www.google.com</a> bar <a href="http://www.google.fr">www.google.fr</a> baz', 'foo http://www.google.com bar http://www.google.fr baz'),
            array('<a href="http://www.google.com/index.php?foo=bar&baz=true">www.google.com/index.php?foo=bar&baz=true</a>', 'http://www.google.com/index.php?foo=bar&baz=true'),
            array('<a href="https://www.google.com/index.php?foo=bar&baz=true">www.google.com/index.php?foo=bar&baz=true</a>', 'https://www.google.com/index.php?foo=bar&baz=true'),
        );
    }

    /**
     * @dataProvider getFormatHttpLinkTests
     */
    public function testFormatHttpLink($expected, $text)
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
