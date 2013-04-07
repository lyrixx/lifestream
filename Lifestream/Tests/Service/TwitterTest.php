<?php

namespace Lyrixx\Lifestream\Tests\Service;

use Lyrixx\Lifestream\Service\Twitter;

class TwitterTest extends AbstractTest
{
    public function testGetStatuses()
    {
        $service = new Twitter('lyrixx');
        $service->setClient($this->getClient(__DIR__.'/Fixtures/Twitter.xml'));

        $statuses = $service->getStatuses();
        $this->assertCount(12, $statuses);

        $firstStatus = $statuses[0];
        $this->assertEquals('@lsmith Huhu :) @Stof70', $firstStatus->getText());
        $this->assertEquals('http://twitter.com/lyrixx/statuses/260121088363741184', $firstStatus->getUrl());
        $this->assertEquals('2012-10-21', $firstStatus->getDate()->format('Y-m-d'));
    }

    public function getMetadataTest()
    {
        return array(
            array(
                new Twitter('lyrixx', $this->getClient()),
                'https://search.twitter.com/search.atom?q=from%3A%40lyrixx',
                'https://twitter.com/lyrixx',
                'https://twitter.com/lyrixx',
            ),
        );
    }
}
