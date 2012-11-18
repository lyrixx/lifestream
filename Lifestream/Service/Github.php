<?php

namespace Lyrixx\Lifestream\Service;

/**
 * Fetch Github feed
 */
class Github extends Atom
{
    const FEED_URL    = 'https://github.com/%s.atom';
    const PROFILE_URL = 'https://github.com/%s';

    /**
     * Constructor
     * @param [type] $browser  The browser
     * @param string $username The github username
     */
    public function __construct($username, $browser = null)
    {
        $feedUrl = sprintf(self::FEED_URL, $username);
        $profileUrl = sprintf(self::PROFILE_URL, $username);

        parent::__construct($feedUrl, $profileUrl, $browser);
    }
}
