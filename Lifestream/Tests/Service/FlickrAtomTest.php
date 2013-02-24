<?php

namespace Lyrixx\Lifestream\Tests\Sevice;

use Lyrixx\Lifestream\Service\FlickrAtom as Flickr;

class FlickrAtomTest extends AbstractTest
{
    public function testGetStatuses()
    {
        $service = new Flickr(34871318, 'xavierbriand');
        $service->setClient($this->getClient(__DIR__.'/Fixtures/FlickrAtom.xml'));

        $statuses = $service->getStatuses();
        $this->assertCount(20, $statuses);

        $firstStatus = $statuses[0];
        $this->assertEquals('2012-10-08_16-40-58', $firstStatus->getText());
        $this->assertEquals('http://www.flickr.com/photos/xavierbriand/8084404485/', $firstStatus->getUrl());
        $this->assertEquals('2012-10-14', $firstStatus->getDate()->format('Y-m-d'));
    }

    public function getMetadataTest()
    {
        return array(
            array(
                new Flickr(34871318, 'xavierbriand', $this->getClient()),
                'http://api.flickr.com/services/feeds/photos_public.gne?id=34871318@N02&lang=en-us&format=rss_200',
                'http://www.flickr.com/photos/xavierbriand',
                'http://www.flickr.com/photos/xavierbriand'
            ),
        );
    }
}
