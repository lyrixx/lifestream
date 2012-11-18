<?php

namespace Lyrixx\Lifestream\Service;

/**
 * Fetch twitter feed
 */
class Twitter extends Atom
{
    const FEED_URL    = 'http://search.twitter.com/search.atom?q=from%%3A%%40%s';
    const PROFILE_URL = 'https://twitter.com/%s';

    /**
     * Constructor
     *
     * @param [type] $browser  The browser
     * @param string $username The twitter username
     */
    public function __construct($username, $browser = null)
    {
        $feedUrl = sprintf(self::FEED_URL, $username);
        $profileUrl = sprintf(self::PROFILE_URL, $username);

        parent::__construct($feedUrl, $profileUrl, $browser);
    }
}
