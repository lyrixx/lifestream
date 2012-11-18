<?php

namespace Lyrixx\Lifestream\Tests\Sevice;

use Lyrixx\Lifestream\Service\FlickrRss20 as Flickr;

class FlickrRss20Test extends AbstractTest
{
    public function testGetStatuses()
    {
        $service = new Flickr(34871318, 'xavierbriand');
        $service->setBrowser($this->getBrowser(__DIR__.'/Fixtures/FlickrRss20.xml'));

        $statuses = $service->getStatuses();
        $this->assertCount(20, $statuses);

        $firstStatus = $statuses[0];
        $this->assertEquals('2012-10-21', $firstStatus->getText());
        $this->assertEquals('http://www.flickr.com/photos/xavierbriand/8111015452/', $firstStatus->getUrl());
        $this->assertEquals('2012-10-21', $firstStatus->getDate()->format('Y-m-d'));
    }

    public function getMetadataTest()
    {
        return array(
            array(
                new Flickr(34871318, 'xavierbriand', $this->getBrowser()),
                'http://api.flickr.com/services/feeds/photos_public.gne?id=34871318@N02&lang=en-us&format=rss_200',
                'http://www.flickr.com/photos/xavierbriand',
                'http://www.flickr.com/photos/xavierbriand'
            ),
        );
    }
}
