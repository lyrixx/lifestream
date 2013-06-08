<?php

namespace Lyrixx\Lifestream\Service;

use Guzzle\Http\Client;
use Guzzle\Http\Message\Response;

/**
 * AbstractService implements common methods of ServiceInterface
 */
abstract class AbstractService implements ServiceInterface
{
    private $statuses;
    private $statusClassname;
    private $feedUrl;
    private $profileUrl;
    private $client;
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
        $this->feedUrl         = $feedUrl;
        $this->profileUrl      = $profileUrl ?: $feedUrl;
        $this->client          = $client ?: new Client();
        $this->response        = null;
        $this->statuses        = array();
        $this->statusClassname = 'Lyrixx\Lifestream\Status';
    }

    /**
     * Read datas in the response and extract raw status. Should create
     * something Iterable with some datas. Theses data will be use to create a
     * new StatusInterface
     *
     * @param string
     * @return array[array] The datas
     */
    abstract protected function extractRawStatuses($bodyReponse);

    /**
     * {@inheritdoc}
     *
     * @throws \RuntimeException If Client failed to fetch data
     */
    public function getStatuses()
    {
        if (!$this->response) {
            $this->response = $this->prepareRequest()->send();
        }

        if (200 !== $this->response->getStatusCode()) {
            throw new \RuntimeException(sprintf('Client faild with "%s". Status: "%s"', $this->feedUrl , $this->response->getStatusCode()));
        }

        $statuses = $this->extractRawStatuses($this->response->getBody());

        foreach ($statuses as $status) {
            $this->statuses[] = $this->createNewStatusInstance($status);
        }

        return $this->statuses;
    }

    /**
     * {@inheritdoc}
     */
    public function setStatusClassname($statusClassname)
    {
        $this->statusClassname = $statusClassname;
    }

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

    /**
     * {@inheritdoc}
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    /**
     * {@inheritdoc}
     */
    public function prepareRequest()
    {
        return $this->client->get($this->getFeedUrl());
    }

    /**
     * Get a new instance of a status, according to $this->$statusClassname
     *
     * @param array $datas Some datas, to inject into new StatusInterface
     *
     * @return StatusInterface A new status
     */
    protected function createNewStatusInstance($datas = array())
    {
        $class = $this->statusClassname;

        return new $class($datas);
    }
}
