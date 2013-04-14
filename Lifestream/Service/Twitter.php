<?php

namespace Lyrixx\Lifestream\Service;

use Guzzle\Http\Client;

/**
 * Fetch twitter feed
 */
class Twitter extends Atom
{
    const FEED_URL    = 'https://search.twitter.com/search.atom?q=from%%3A%%40%s';
    const PROFILE_URL = 'https://twitter.com/%s';

    /**
     * Constructor
     *
     * @param string $username The twitter username
     * @param Client $client   The client
     */
    public function __construct($username, Client $client = null)
    {
        $feedUrl = sprintf(self::FEED_URL, $username);
        $profileUrl = sprintf(self::PROFILE_URL, $username);

        parent::__construct($feedUrl, $profileUrl, $client);
    }
}
