<?php

namespace Lifestream\Service;

class FlickrRss20 extends Rss20
{

    const FEED_URL    = 'http://api.flickr.com/services/feeds/photos_public.gne?id=%s@N02&lang=en-us&format=rss_200';
    const PROFILE_URL = 'http://www.flickr.com/photos/%s';

    public function __construct($browser, $userId, $username)
    {
        $feedUrl = sprintf(self::FEED_URL, $userId, $username);
        $profileUrl = sprintf(self::PROFILE_URL, $username);

        parent::__construct($browser, $feedUrl, $profileUrl);
    }

    protected function formatDatas($datas)
    {
        $date = new \Datetime($datas->pubDate);

        return array(
            'text'        => $date->format('Y-m-d'),
            'description' => (string) $datas->description,
            'url'         => (string) $datas->link,
            'date'        => $date,
        );
    }

}
