<?php

namespace Lyrixx\Lifestream\Service;

use Guzzle\Http\Client;
use Guzzle\Http\Message\Response;

/**
 * AbstractFeed implements common methods of ServiceFeedInterface
 */
abstract class AbstractFeed extends AbstractService implements ServiceFeedInterface
{
    protected $feedUrl;
    protected $profileUrl;
    protected $client;
    private $response;

    /**
     * Constructor
     *
     * @param string $feedUrl    A Feed url
     * @param string $profileUrl A profileUrl
     * @param Client $client     A client
     */
    public function __construct($feedUrl, $profileUrl = null, Client $client = null)
    {
        $this->client     = $client ?: new Client();
        $this->feedUrl    = $feedUrl;
        $this->profileUrl = $profileUrl ?: $feedUrl;
        $this->response   = null;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \RuntimeException If Client failed to fetch data
     */
    protected function getDatas()
    {
        if (!$this->response) {
            $this->response = $this->client->get($feedUrl = $this->getFeedUrl())->send();
        }

        if (200 !== $this->response->getStatusCode()) {
            throw new \RuntimeException(sprintf('Client faild with "%s". Status: "%s"', $feedUrl , $this->response->getStatusCode()));
        }

        return $this->extractDatas($this->response->getBody());
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
        $class = explode('\\', get_class($this));

        return end($class);
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

    public function setResponse(Response $response)
    {
        $this->response = $response;
    }
}
