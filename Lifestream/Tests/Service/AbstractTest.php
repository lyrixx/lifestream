<?php

namespace Lyrixx\Lifestream\Tests\Service;

use Guzzle\Http\Client;
use Guzzle\Plugin\Mock\MockPlugin;
use Guzzle\Http\Message\Response;

abstract class AbstractTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getMetadataTest
     */
    public function testMetadata($service, $feedUrl, $profileUrl, $name)
    {
        $this->assertEquals($feedUrl, $service->getFeedUrl());
        $this->assertEquals($profileUrl, $service->getProfileUrl());
        $this->assertEquals($name, $service->getName());
    }

    abstract public function getMetadataTest();

    public function getClient($fixtureFilePath = null)
    {
        if (null === $fixtureFilePath) {
            return $this->getMock('Guzzle\Http\Client');
        }

        $response = new Response(200);
        $response->setBody(file_get_contents($fixtureFilePath));

        $mock = new MockPlugin();
        $mock->addResponse($response);

        $client = new Client();
        $client->addSubscriber($mock);

        return $client;
    }
}
