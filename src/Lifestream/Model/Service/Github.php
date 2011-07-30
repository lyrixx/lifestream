<?php

namespace Lifestream\Model\Service;

/**
 *
 * @package Lifestream
 * @subpackage Service
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
class Github extends Atom
{
    const SERVICE_URL = 'https://github.com/%s';
    const FEED_URL = 'https://github.com/%s.atom';

    private $username = null;

    /**
     *
     * @inheritdoc
     */
    protected function getFeedUrl()
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
