<?php

namespace Lyrixx\Lifestream\Tests\Service;

use Guzzle\Http\Client;
use Lyrixx\Lifestream\Service\TwitterList;
use Lyrixx\Lifestream\Service\TwitterSearch;
use Lyrixx\Lifestream\Service\Aggregate;
use Guzzle\Plugin\Mock\MockPlugin;
use Guzzle\Http\Message\Response;

class AggregateTest extends \PHPUnit_Framework_TestCase
{
    public function testGetStatuses()
    {
        $mock = new MockPlugin();
        $mock
            ->addResponse(new Response(200, null, file_get_contents(__DIR__.'/Fixtures/TwitterList.json')))
            ->addResponse(new Response(200, null, file_get_contents(__DIR__.'/Fixtures/TwitterSearch.json')))
        ;

        $client = new Client();
        $client->addSubscriber($mock);

        $service = new Aggregate(array(
            new TwitterList('consumerKey', 'consumerSecret', 'accessToken', 'accessTokenSecret', 'futurecat', 'sensio'),
            new TwitterSearch('consumerKey', 'consumerSecret', 'accessToken', 'accessTokenSecret', '#Symfony2'),
        ));
        $service->setClient($client);

        $statuses = $service->getStatuses();
        $this->assertCount(35, $statuses);

        foreach (array_values($statuses) as $k => $status) {
            if (0 === $k) {
                continue;
            }
            $this->assertGreaterThanOrEqual($statuses[$k - 1]->getDate(), $status->getDate());
            $this->assertInstanceOf('Lyrixx\Lifestream\StatusInterface', $status);
        }
    }
}
