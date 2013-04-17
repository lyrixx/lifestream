<?php

namespace Lyrixx\Lifestream\Tests\Service;

use Lyrixx\Lifestream\Service\TwitterSearch;

class TwitterSearchTest extends AbstractTest
{
    public function testGetStatuses()
    {
        $service = new TwitterSearch('symfony');
        $service->setClient($this->getClient(__DIR__.'/Fixtures/TwitterSearch.xml'));

        $statuses = $service->getStatuses();
        $this->assertCount(15, $statuses);

        $firstStatus = reset($statuses);
        $this->assertInstanceOf('Lyrixx\Lifestream\Status\AdvancedStatus', $firstStatus);
        $this->assertSame('RT @AdrienBrault: My #symfony2 phpstorm plugin is available http://t.co/pYMDngju9D (screenshot included). Detect ContainerInterface::get ...', $firstStatus->getText());
        $this->assertSame('http://twitter.com/usul_/statuses/320951003727929344', $firstStatus->getUrl());
        $this->assertSame('2013-04-07', $firstStatus->getDate()->format('Y-m-d'));
        $this->assertSame('usul_', $firstStatus->getUsername());
        $this->assertSame('François Dussert', $firstStatus->getFullname());
        $this->assertSame('http://a0.twimg.com/profile_images/1846232082/962C5F6F-B0EE-4B8B-8C5F-12C7934FA866_normal', $firstStatus->getPictureUrl());
        $this->assertSame('http://twitter.com/usul_', $firstStatus->getProfileUrl());
    }

    public function getMetadataTest()
    {
        return array(
            array(
                new TwitterSearch('symfony', $this->getClient()),
                'https://search.twitter.com/search.atom?q=symfony&include_entities=true',
                'https://twitter.com/search/realtime?q=symfony',
                'TwitterSearch',
            ),
        );
    }
}
