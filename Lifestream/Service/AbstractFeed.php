<?php

namespace Lifestream\Service;

/**
 * AbstractFeed implements common methods of ServiceFeedInterface
 */
abstract class AbstractFeed extends AbstractService implements ServiceFeedInterface
{
    protected $feedUrl;
    protected $profileUrl;
    protected $browser;

    /**
     * Constructor
     *
     * @param [type] $browser    A browser
     * @param string $feedUrl    A Feed url
     * @param string $profileUrl A profileUrl
     */
    public function __construct($browser, $feedUrl, $profileUrl = null)
    {
        $this->browser    = $browser;
        $this->feedUrl    = $feedUrl;
        $this->profileUrl = $profileUrl ?: $feedUrl;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \RunetimeException If Browser failed to fetch data
     */
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

    /**
     * Should extra datas from $xml and return an
     * array with theses data
     *
     * Theses data will be use to create a new StatusInterface
     *
     * @param \SimpleXMLElement $xml The raw datas
     *
     * @return array The datas
     */
    abstract protected function extractDatas(\SimpleXMLElement $xml);

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getProfileUrl();
    }

    /**
     * {@inheritdoc}
     */
    public function setBrowser($browser)
    {
        $this->browser = $browser;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getFeedUrl()
    {
        return $this->feedUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function getProfileUrl()
    {
        return $this->profileUrl;
    }

    /**
     * Return the current browser
     *
     * @return [type] The browser
     */
    protected function getBrowser()
    {
        return $this->browser;
    }
}
