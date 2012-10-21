<?php

namespace Lifestream\Service;

class Flickr extends Atom
{

    const FEED_URL    = 'http://api.flickr.com/services/feeds/photos_public.gne?id=%s@N02&lang=en-us&format=rss_200';
    const PROFILE_URL = 'http://www.flickr.com/photos/%s';

    public function __construct($browser, $userId, $username)
    {
        $feedUrl = sprintf(self::FEED_URL, $userId, $username);
        $profileUrl = sprintf(self::PROFILE_URL, $username);

        parent::__construct($browser, $feedUrl, $profileUrl);
    }
}
