<?php

namespace Lyrixx\Lifestream\Tests\Service;

use Lyrixx\Lifestream\Service\Atom;

class AtomTest extends AbstractTest
{
    public function testGetStatuses()
    {
        $service = new Atom('http://localhost/feed.xml');
        $service->setClient($this->getClient(__DIR__.'/Fixtures/Atom.xml'));

        $statuses = $service->getStatuses();
        $this->assertCount(5, $statuses);

        $firstStatus = $statuses[0];
        $this->assertEquals('Atom-Powered Robots Run Amok', $firstStatus->getText());
        $this->assertEquals('http://example.org/2003/12/13/atom03', $firstStatus->getUrl());
        $this->assertEquals('2003-12-13', $firstStatus->getDate()->format('Y-m-d'));
    }

    public function getMetadataTest()
    {
        return array(
            array(
                new Atom($name = 'http://localhost/feed.xml', null, $this->getClient()),
                $name,
                $name,
                $name
            ),
        );
    }
}
