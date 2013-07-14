<?php

namespace Lyrixx\Lifestream\Tests\Service;

use Lyrixx\Lifestream\Service\Twitter;

class TwitterTest extends AbstractTest
{
    public function testGetStatuses()
    {
        $service = new Twitter('consumerKey', 'consumerSecret', 'accessToken', 'accessTokenSecret', 'lyrixx', array(), $this->getTwitterSdK(__DIR__.'/Fixtures/Twitter.json'));

        $statuses = $service->getStatuses();
        $this->assertCount(15, $statuses);

        $firstStatus = reset($statuses);
        $this->assertEquals('And already merge 2 PRs ;)', $firstStatus->getText());
        $this->assertEquals('https://twitter.com/lyrixx/status/356113849855901696', $firstStatus->getUrl());
        $this->assertEquals('2013-07-13', $firstStatus->getDate()->format('Y-m-d'));
    }

    public function getMetadataTest()
    {
        return array(
            array(
                new Twitter('consumerKey', 'consumerSecret', 'accessToken', 'accessTokenSecret', 'lyrixx', array(), $this->getTwitterSdK(__DIR__.'/Fixtures/Twitter.json')),
                'https://twitter.com/search?q=from%3A%40lyrixx',
                'https://twitter.com/search?q=from%3A%40lyrixx',
                'Twitter',
            ),
        );
    }
}
