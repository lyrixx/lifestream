<?php

namespace Lifestream\Tests\Sevice;

use Lifestream\Service\Atom;

class AtomTest extends AbstractTest
{
    public function testGetStatuses()
    {
        $service = new Atom($this->getBrowser(__DIR__.'/Fixtures/Atom.xml'), 'http://localhost/feed.xml');

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
                new Atom($this->getBrowser(), $name = 'http://localhost/feed.xml'),
                $name,
                $name,
                $name
            ),
        );
    }
}
