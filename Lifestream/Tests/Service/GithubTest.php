<?php

namespace Lyrixx\Lifestream\Tests\Service;

use Lyrixx\Lifestream\Service\Github;

class GithubTest extends AbstractTest
{
    public function testGetStatuses()
    {
        $service = new Github('lyrixx');
        $service->setClient($this->getClient(__DIR__.'/Fixtures/Github.xml'));

        $statuses = $service->getStatuses();
        $this->assertCount(30, $statuses);

        $firstStatus = $statuses[0];
        $this->assertEquals('lyrixx closed issue lyrixx/lifestream#1', $firstStatus->getText());
        $this->assertEquals('https://github.com/lyrixx/lifestream/issues/1', $firstStatus->getUrl());
        $this->assertEquals('2012-10-21', $firstStatus->getDate()->format('Y-m-d'));
    }

    public function getMetadataTest()
    {
        return array(
            array(
                new Github('lyrixx', $this->getClient()),
                'https://github.com/lyrixx.atom',
                'https://github.com/lyrixx',
                'https://github.com/lyrixx'
            ),
        );
    }
}
