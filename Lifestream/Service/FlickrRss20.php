<?php

namespace Lyrixx\Lifestream\Service;

use Guzzle\Http\Client;

/**
 * Fetch flickr feed with RSS 2.0 channel
 */
class FlickrRss20 extends Rss20
{
    const FEED_URL    = 'http://api.flickr.com/services/feeds/photos_public.gne?id=%s@N02&lang=en-us&format=rss_200';
    const PROFILE_URL = 'http://www.flickr.com/photos/%s';

    /**
     * Constructor
     *
     * @param string $userId   The flickr user id
     * @param string $username The flickr username
     * @param Client $client   A client
     */
    public function __construct($userId, $username, Client $client = null)
    {
        $feedUrl = sprintf(self::FEED_URL, $userId, $username);
        $profileUrl = sprintf(self::PROFILE_URL, $username);

        parent::__construct($feedUrl, $profileUrl, $client);
    }

    /**
     * {@inheritdoc}
     */
    protected function formatDatas(\SimpleXMLElement $datas)
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
