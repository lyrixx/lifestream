<?php

namespace Lifestream\Service;

class Github extends Atom
{

    const FEED_URL    = 'https://github.com/%s.atom';
    const PROFILE_URL = 'https://github.com/%s';

    public function __construct($browser, $username)
    {
        $feedUrl = sprintf(self::FEED_URL, $username);
        $profileUrl = sprintf(self::PROFILE_URL, $username);

        parent::__construct($browser, $feedUrl, $profileUrl);
    }
}
