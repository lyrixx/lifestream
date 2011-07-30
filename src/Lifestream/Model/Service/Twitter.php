<?php

namespace Lifestream\Model\Service;

/**
 *
 * @package Lifestream
 * @subpackage Service
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
class Twitter extends Rss
{
    const SERVICE_URL = 'https://twitter.com/%s';
    const FEED_URL = 'https://twitter.com/statuses/user_timeline.rss?screen_name=%s';

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

    /**
     *
     * @inheritdoc
     * Override in order to remove username
     */
    protected function processRawDatas()
    {
        $this->preProcessRawDatas();
        foreach ($this->rawDatas as $data) {
            $this->serviceStream->addStatus(array(
                'text'          => substr($data['text'], strlen($this->getUsername()) + 2),
                'url'           => $data['url'],
                'date'          => $data['date'],
                'categories'    => $data['categories'],
            ));
        }
    }

    public function getUsername()
    {
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