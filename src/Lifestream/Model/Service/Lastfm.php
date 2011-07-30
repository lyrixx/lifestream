<?php

namespace Lifestream\Model\Service;

/**
 * Class for fetch twitter. Use a provider, in this case Zend\Service\Twitter\Search
 *
 * @package Lifestream
 * @subpackage Service
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
class Lastfm extends BaseFeed
{
    const SERVICE_URL = 'http://www.last.fm/user/%s';
    const FEED_URL = 'http://ws.audioscrobbler.com/2.0/user/%s/topartists.xml?period=3month';

    private $username = null;

    /**
     *
     * @inheritdoc
     */
    protected function getFeedUrl($maxItem = 15)
    {
        return sprintf(self::FEED_URL, $this->getUsername());
    }

    /**
     *
     * @inheritdoc
     */
    public function getServiceURL()
    {
        return sprintf(self::SERVICE_URL, $this->getUsername());
    }

    public function getUsername()     {
        if (!$this->username) {
            throw new \RuntimeException('Unifined username');
        }

        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }


}
