<?php

namespace Lyrixx\Lifestream\Service;

use Guzzle\Http\Client;
use Guzzle\Http\Message\Response;
use Guzzle\Http\Message\Request;

/**
 * ServiceFeedInterface will be in charges to fetch remotes (over http) datas,
 * and convert each status to a StatusInterface object.
 */
interface ServiceFeedInterface extends ServiceInterface
{
    /**
     * Set a client
     *
     * @todo Use a typint here
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
     * @param Response $response [description]
     */
    public function setResponse(Response $response);

    /**
     * Prepare the request
     *
     * @return Request
     */
    public function prepareRequest();
}
