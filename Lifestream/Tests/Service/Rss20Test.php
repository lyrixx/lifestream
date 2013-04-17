<?php

namespace Lyrixx\Lifestream\Tests\Service;

use Lyrixx\Lifestream\Service\Rss20 as Rss;

class Rss20Test extends AbstractTest
{
    public function testGetStatuses()
    {
        $service = new Rss('http://localhost/feed.xml');
        $service->setClient($this->getClient(__DIR__.'/Fixtures/Rss20.xml'));

        $statuses = $service->getStatuses();
        $this->assertCount(5, $statuses);
        $firstStatus = $statuses[0];
        $this->assertEquals('Actualite N1', $firstStatus->getText());
        $this->assertEquals(
            array(
                'description' => 'Ceci est ma premiere actualite',
                'categories'  => array()
            ),
            $firstStatus->getExtra()
        );
        $this->assertEquals('2002-09-07', $firstStatus->getDate()->format('Y-m-d'));
    }

    public function getMetadataTest()
    {
        return array(
            array(
                new Rss($name = 'http://localhost/feed.xml', null, $this->getClient()),
                $name,
                $name,
                'Rss20'
            ),
        );
    }
}
