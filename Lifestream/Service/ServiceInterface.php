<?php

namespace Lyrixx\Lifestream\Service;

use Guzzle\Http\Client;
use Guzzle\Http\Message\Request;
use Guzzle\Http\Message\Response;
use Lyrixx\Lifestream\StatusInterface;

/**
 * ServiceInterface will be in charges to fetch remotes (over http) datas, and
 * convert each status to a StatusInterface object.
 */
interface ServiceInterface
{
    /**
     * Returns a collection of StatusInterface
     *
     * @return StatusInterface[] A colection StatusInterface
     */
    public function getStatuses();

    /**
     * Returns the service name
     *
     * @return string The service name
     */
    public function getName();

    /**
     * Sets the status classname.
     * Must implement StatusInterface.
     *
     * I will be used to create a new StatusInterface with fetched datas
     *
     * @param string $statusClassname The status classname
     */
    public function setStatusClassname($statusClassname);

    /**
     * Set a client
     *
     * @param Client $client A client
     */
    public function setClient(Client $client);

    /**
     * Return the full url to the feed.
     *
     * @return string The feed Url
     */
    public function getFeedUrl();

    /**
     * Return the full url to the profile
     *
     * @return string The profile url
     */
    public function getProfileUrl();

    /**
     * Set the response
     *
     * Usefull for multicurl
     *
     * @param Response $response
     */
    public function setResponse(Response $response);

    /**
     * Prepare the request
     *
     * @return Request
     */
    public function prepareRequest();

}
