<?php

namespace Lyrixx\Lifestream\Tests;

use Lyrixx\Lifestream\Status;

/**
 * Test class for StatusStream.
 */
class StatusTest extends \PHPUnit_Framework_TestCase
{
    public function testAddStatus()
    {
        $datas = array(
            'text' => 'some text',
            'date' => new \DateTime('2000-01-01'),
            'url' => 'http://exemple.com',
            'option1' => 'my first option',
            'option2' => 'my second option',
            'option3' => 'my third option',
        );

        $status = new Status($datas);

        $this->assertEquals($datas['text'], $status->__ToString(), 'Check ToString ()');
        $this->assertEquals($datas['text'], $status->getText(), 'Check Text');
        $this->assertEquals($datas['date'], $status->getDate(), 'Check Date');
        $this->assertEquals($datas['url'],  $status->getUrl(),  'Check Url');
        $options = array(
            'option1' => 'my first option',
            'option2' => 'my second option',
            'option3' => 'my third option',
        );
        $this->assertEquals($options, $status->getExtra(), 'Check Extra');
    }

}
