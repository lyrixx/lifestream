<?php

namespace Lifestream\Model\Service;

/**
 *
 * @package Lifestream
 * @subpackage Service
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
class Delicious extends Rss
{
    const SERVICE_URL = 'http://www.delicious.com/%s';
    const FEED_URL = 'http://feeds.delicious.com/v2/rss/%s?count=15';

    private $username = null;

    /**
     *
     * @inheritdoc
     */
    protected function getFeedUrl()
    {
        return $url = sprintf(self::FEED_URL, $this->getUsername());
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
