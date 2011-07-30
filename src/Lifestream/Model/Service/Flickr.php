<?php

namespace Lifestream\Model\Service;

/**
 *
 * @package Lifestream
 * @subpackage Service
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
class Flickr extends BaseFeed
{
    const SERVICE_URL = 'http://www.flickr.com/photos/%s';
    const FEED_URL = 'http://api.flickr.com/services/feeds/photos_public.gne?id=%s@N02&lang=en-us&format=rss_200';

    private $username = null;
    private $userid = null;

    /**
     *
     * @inheritdoc
     */
    protected function getFeedUrl()
    {
        return sprintf(self::FEED_URL, $this->getUserid());
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

    public function getUserid()     {
        if (!$this->userid) {
            throw new \RuntimeException('Unifined userid');
        }

        return $this->userid;
    }

    public function setUserid($userid)
    {
        $this->userid = $userid;
    }




}
