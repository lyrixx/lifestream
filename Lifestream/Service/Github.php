<?php

namespace Lyrixx\Lifestream\Service;

use Guzzle\Http\Client;

/**
 * Fetch Github feed
 */
class Github extends Atom
{
    const FEED_URL    = 'https://github.com/%s.atom';
    const PROFILE_URL = 'https://github.com/%s';

    /**
     * Constructor
     *
     * @param string $username The github username
     * @param Client $client   The client
     */
    public function __construct($username, Client $client = null)
    {
        $feedUrl = sprintf(self::FEED_URL, $username);
        $profileUrl = sprintf(self::PROFILE_URL, $username);

        parent::__construct($feedUrl, $profileUrl, $client);
    }
}
