<?php

namespace Lifestream\Service;

class Twitter extends Atom
{

    const FEED_URL    = 'http://search.twitter.com/search.atom?q=from%%3A%%40%s';
    const PROFILE_URL = 'https://twitter.com/%s';

    public function __construct($browser, $username)
    {
        $feedUrl = sprintf(self::FEED_URL, $username);
        $profileUrl = sprintf(self::PROFILE_URL, $username);

        parent::__construct($browser, $feedUrl, $profileUrl);
    }
}
