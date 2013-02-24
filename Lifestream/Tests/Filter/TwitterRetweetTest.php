<?php

namespace Lyrixx\Lifestream\Tests\Filter;

use Lyrixx\Lifestream\Filter\TwitterRetweet;

class TwitterRetweetTest extends AbstractTest
{
    public function getFilterTests()
    {
        return array(
            array(true, ''),
            array(true, 'Hi'),
            array(true, 'Hi @lyrixx RT @lyrixx'),
            array(false, 'RT @lyrixx'),
            array(false, 'RT @lyrixx Hi'),
        );
    }

    protected function createNewFilter()
    {
        return new TwitterRetweet();
    }
}
