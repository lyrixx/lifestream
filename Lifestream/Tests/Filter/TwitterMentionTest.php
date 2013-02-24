<?php

namespace Lyrixx\Lifestream\Tests\Filter;

use Lyrixx\Lifestream\Filter\TwitterMention;

class TwitterMentioTest extends AbstractTest
{
    public function getFilterTests()
    {
        return array(
            array(true, ''),
            array(true, 'Hi'),
            array(true, 'Hi @lyrixx'),
            array(false, '@lyrixx'),
            array(false, '@lyrixx Hi'),
        );
    }

    protected function createNewFilter()
    {
        return new TwitterMention();
    }
}
