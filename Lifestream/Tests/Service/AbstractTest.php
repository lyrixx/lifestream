<?php

namespace Lyrixx\Lifestream\Tests\Sevice;

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

    public function getBrowser($fixtureFilePath = null)
    {
        if (null == $fixtureFilePath) {
            return $this->getMock('Buzz\Browser');
        }
        $response = new \Buzz\Message\Response();
        $response->setContent(file_get_contents($fixtureFilePath));
        $response->setHeaders(array('HTTP/1.1 200 OK'));

        $browser = $this->getMock('Buzz\Browser');
        $browser
            ->expects($this->once())
            ->method('get')
            ->will($this->returnValue($response))
        ;

        return $browser;
    }
}
