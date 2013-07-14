<?php

namespace Lyrixx\Lifestream\Tests\Service;

use Lyrixx\Lifestream\Service\TwitterSearch;

class TwitterSearchTest extends AbstractTest
{
    public function testGetStatuses()
    {
        $service = new TwitterSearch('consumerKey', 'consumerSecret', 'accessToken', 'accessTokenSecret', '#Symfony2', array(), $this->getTwitterSdK(__DIR__.'/Fixtures/TwitterSearch.json'));

        $statuses = $service->getStatuses();
        $this->assertCount(15, $statuses);

        $firstStatus = reset($statuses);
        $this->assertInstanceOf('Lyrixx\Lifestream\Status\AdvancedStatus', $firstStatus);
        $this->assertSame('Bakıda #Symfony2 bilən axtarılır :)', $firstStatus->getText());
        $this->assertSame('https://twitter.com/seferov/status/356366015350837248', $firstStatus->getUrl());
        $this->assertSame('2013-07-14', $firstStatus->getDate()->format('Y-m-d'));
        $this->assertSame('seferov', $firstStatus->getUsername());
        $this->assertSame('Farhad Safarov', $firstStatus->getFullname());
        $this->assertSame('http://a0.twimg.com/profile_images/1479678848/seferov_normal.jpg', $firstStatus->getPictureUrl());
        $this->assertSame('https://twitter.com/seferov', $firstStatus->getProfileUrl());
    }

    public function getMetadataTest()
    {
        return array(
            array(
                new TwitterSearch('consumerKey', 'consumerSecret', 'accessToken', 'accessTokenSecret', '#Symfony2', array(), $this->getTwitterSdK(__DIR__.'/Fixtures/TwitterSearch.json')),
                'https://twitter.com/search?q=%23Symfony2',
                'https://twitter.com/search?q=%23Symfony2',
                'TwitterSearch',
            ),
        );
    }
}
