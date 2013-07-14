<?php

namespace Lyrixx\Lifestream\Tests\Service;

use Lyrixx\Lifestream\Service\TwitterList;

class TwitterListTest extends AbstractTest
{
    public function testGetStatuses()
    {
        $service = new TwitterList('consumerKey', 'consumerSecret', 'accessToken', 'accessTokenSecret', 'futurecat', 'sensio', array(), $this->getTwitterSdK(__DIR__.'/Fixtures/TwitterList.json'));

        $statuses = $service->getStatuses();
        $this->assertCount(20, $statuses);

        $firstStatus = reset($statuses);
        $this->assertInstanceOf('Lyrixx\Lifestream\Status\AdvancedStatus', $firstStatus);
        $this->assertEquals('Pour les différences de robe, œil bionique recommandé http://t.co/novD9DUWgz', $firstStatus->getText());
        $this->assertEquals('https://twitter.com/laurentLC/statuses/356358506347122688', $firstStatus->getUrl());
        $this->assertEquals('2013-07-14', $firstStatus->getDate()->format('Y-m-d'));
        $this->assertSame('laurentLC', $firstStatus->getUsername());
        $this->assertSame('LaurentLC', $firstStatus->getFullname());
        $this->assertSame('http://a0.twimg.com/profile_images/3002876591/3a97957ac5f45c422b35689d5fdf4b40_normal.jpeg', $firstStatus->getPictureUrl());
        $this->assertSame('https://twitter.com/laurentLC', $firstStatus->getProfileUrl());
    }

    public function getMetadataTest()
    {
        return array(
            array(
                new TwitterList('consumerKey', 'consumerSecret', 'accessToken', 'accessTokenSecret', 'futurecat', 'sensio', array(), $this->getTwitterSdK(__DIR__.'/Fixtures/TwitterList.json')),
                'https://twitter.com/futurecat/sensio',
                'https://twitter.com/futurecat/sensio',
                'TwitterList',
            ),
        );
    }
}
