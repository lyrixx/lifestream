<?php

namespace Lifestream\Service;

/**
 *
 * @package Lifestream
 * @subpackage Service
 * @author lyrix
 */
abstract class AbstractFeed extends AbstractService implements ServiceFeedInterface
{

    protected $feedUrl;
    protected $profileUrl;
    protected $browser;

    public function __construct($browser, $feedUrl, $profileUrl = null)
    {
        $this->browser    = $browser;
        $this->feedUrl    = $feedUrl;
        $this->profileUrl = $profileUrl ?: $feedUrl;
    }

    protected function getDatas()
    {
        $response = $this->getBrowser()->get($feedUrl = $this->getFeedUrl());

        if (!$content = $response->getContent()) {
            throw new \RuntimeException(sprintf('Data fetching failed (feedUrl : "%s")', $feedUrl ));
        }

        if (200 != $response->getStatusCode()) {
            throw new \RuntimeException(sprintf('Browser faild with "%s" ; Status : "%s"', $feedUrl , $response->getStatusCode()));
        }

        $xml = new \SimpleXMLElement($content);

        return $this->extractDatas($xml);
    }

    abstract protected function extractDatas(\SimpleXMLElement $xml);

    public function getName()
    {
        return $this->getProfileUrl();
    }

    public function getBrowser()
    {
        return $this->browser;
    }

    public function setBrowser($browser)
    {
        $this->browser = $browser;

        return $this;
    }

    public function getFeedUrl()
    {
        return $this->feedUrl;
    }

    public function setFeedUrl($feedUrl)
    {
        $this->feedUrl = $feedUrl;

        return $this;
    }

    public function getProfileUrl()
    {
        return $this->profileUrl;
    }

    public function setProfileUrl($profileUrl)
    {
        $this->profileUrl = $profileUrl;

        return $this;
    }
}
