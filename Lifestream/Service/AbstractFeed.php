<?php

namespace Lyrixx\Lifestream\Service;

use Guzzle\Http\Client;

/**
 * AbstractFeed implements common methods of ServiceFeedInterface
 */
abstract class AbstractFeed extends AbstractService implements ServiceFeedInterface
{
    protected $feedUrl;
    protected $profileUrl;
    protected $client;

    /**
     * Constructor
     *
     * @param string $feedUrl    A Feed url
     * @param string $profileUrl A profileUrl
     * @param Client $client     A client
     */
    public function __construct($feedUrl, $profileUrl = null, Client $client = null)
    {
        $this->client     = $client;
        $this->feedUrl    = $feedUrl;
        $this->profileUrl = $profileUrl ?: $feedUrl;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \RunetimeException If Client failed to fetch data
     */
    protected function getDatas()
    {
        if (null === $this->client) {
            throw new \RuntimeException('You must set up a client before call AbtractFeed::getDatas()');
        }

        $response = $this->client->get($feedUrl = $this->getFeedUrl())->send();

        if (200 != $response->getStatusCode()) {
            throw new \RuntimeException(sprintf('Client faild with "%s" ; Status : "%s"', $feedUrl , $response->getStatusCode()));
        }

        return $this->extractDatas($response->getBody());
    }

    /**
     * Should extra datas from $xml and return an
     * array with theses data
     *
     * Theses data will be use to create a new StatusInterface
     *
     * @param string $datas
     *
     * @return array The datas
     */
    abstract protected function extractDatas($datas);

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
    public function setClient(Client $client)
    {
        $this->client = $client;

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
}
