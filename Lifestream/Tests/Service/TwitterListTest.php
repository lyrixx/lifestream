<?php

namespace Lyrixx\Lifestream\Tests\Service;

use Lyrixx\Lifestream\Service\TwitterList;

class TwitterListTest extends AbstractTest
{
    public function testGetStatuses()
    {
        $service = new TwitterList('futurecat', 'sensio');
        $service->setClient($this->getClient(__DIR__.'/Fixtures/TwitterList.json'));

        $statuses = $service->getStatuses();
        $this->assertCount(12, $statuses);

        $firstStatus = $statuses[0];
        $this->assertEquals('@lyrixx un autre jour ;)', $firstStatus->getText());
        $this->assertEquals('https://twitter.com/futurecat/statuses/320926532933672961', $firstStatus->getUrl());
        $this->assertEquals('2013-04-07', $firstStatus->getDate()->format('Y-m-d'));
    }

    public function getMetadataTest()
    {
        return array(
            array(
                new TwitterList('futurecat', 'sensio', $this->getClient()),
                'https://api.twitter.com/1/lists/statuses.json?owner_screen_name=futurecat&slug=sensio&include_entities=true',
                'https://twitter.com/futurecat/sensio',
                'https://twitter.com/futurecat/sensio',
            ),
        );
    }
}
