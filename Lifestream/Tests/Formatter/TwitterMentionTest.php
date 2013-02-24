<?php

namespace Lyrixx\Lifestream\Tests\Formatter;

use Lyrixx\Lifestream\Formatter\TwitterMention;
use Lyrixx\Lifestream\Status;

class TwitterMentionTest extends AbstractTest
{
    public function getFormatTests()
    {
        return array(
            array('', ''),
            array('foo', 'foo'),
            array('<a href="https://twitter.com/lyrixx">@lyrixx</a>', '@lyrixx'),
            array('foo <a href="https://twitter.com/lyrixx">@lyrixx</a>', 'foo @lyrixx'),
            array('<a href="https://twitter.com/lyrixx">@lyrixx</a> foo', '@lyrixx foo'),
            array('foo <a href="https://twitter.com/lyrixx">@lyrixx</a> bar <a href="https://twitter.com/greg">@greg</a> baz', 'foo @lyrixx bar @greg baz'),
            array('<a href="https://twitter.com/h4t4g">@h4t4g</a>', '@h4t4g'),
        );
    }

    protected function createNewFormater()
    {
        return new TwitterMention();
    }
}
