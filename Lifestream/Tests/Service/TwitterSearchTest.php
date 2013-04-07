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
        $this->assertEquals('RT @AdrienBrault: My #symfony2 phpstorm plugin is available http://t.co/pYMDngju9D (screenshot included). Detect ContainerInterface::get ...', $firstStatus->getText());
        $this->assertEquals('http://twitter.com/usul_/statuses/320951003727929344', $firstStatus->getUrl());
        $this->assertEquals('2013-04-07', $firstStatus->getDate()->format('Y-m-d'));
    }

    public function getMetadataTest()
    {
        return array(
            array(
                new TwitterSearch('symfony', $this->getClient()),
                'https://search.twitter.com/search.atom?q=symfony&include_entities=true',
                'https://twitter.com/search/realtime?q=symfony',
                'https://twitter.com/search/realtime?q=symfony',
            ),
        );
    }
}
