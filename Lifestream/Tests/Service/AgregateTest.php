<?php

namespace Lyrixx\Lifestream\Tests\Service;

use Guzzle\Http\Client;
use Lyrixx\Lifestream\Service\TwitterList;
use Lyrixx\Lifestream\Service\TwitterSearch;
use Lyrixx\Lifestream\Service\Agregate;
use Guzzle\Plugin\Mock\MockPlugin;
use Guzzle\Http\Message\Response;

class AgregateTest extends \PHPUnit_Framework_TestCase
{
    public function testGetStatuses()
    {
        $mock = new MockPlugin();
        $mock
            ->addResponse(new Response(200, null, file_get_contents(__DIR__.'/Fixtures/TwitterList.json')))
            ->addResponse(new Response(200, null, file_get_contents(__DIR__.'/Fixtures/TwitterSearch.xml')))
        ;

        $client = new Client();
        $client->addSubscriber($mock);

        $service = new Agregate(array(
            new TwitterList('futurecat', 'sensio'),
            new TwitterSearch('symfony'),
        ));
        $service->setClient($client);

        $statuses = $service->getStatuses();

        $this->assertCount(27, $statuses);

        foreach (array_values($statuses) as $k => $status) {
            if (0 === $k) {
                continue;
            }
            $this->assertGreaterThanOrEqual($statuses[$k - 1]->getDate(), $status->getDate());
            $this->assertInstanceOf('Lyrixx\Lifestream\StatusInterface', $status);
        }
    }
}
