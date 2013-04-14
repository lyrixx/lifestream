<?php

namespace Lyrixx\Lifestream\Service;

use Guzzle\Http\Client;

/**
 * Fetch twitter list
 */
class TwitterList extends AbstractFeed
{
    const FEED_URL    = 'https://api.twitter.com/1/lists/statuses.json?owner_screen_name=%s&slug=%s&include_entities=true';
    const PROFILE_URL = 'https://twitter.com/%s/%s';
    const TWEET_URL   = 'https://twitter.com/%s/statuses/%s';

    /**
     * Constructor
     *
     * @param string $username The twitter username
     * @param string $list     The twitter list name
     * @param Client $client   The client
     */
    public function __construct($username, $list, Client $client = null)
    {
        $feedUrl = sprintf(self::FEED_URL, $username, $list);
        $profileUrl = sprintf(self::PROFILE_URL, $username, $list);

        parent::__construct($feedUrl, $profileUrl, $client);
    }

    /**
     * {@inheritdoc}
     */
    protected function extractDatas($datasTmp)
    {
        $datas = array();
        foreach (json_decode((string) $datasTmp, true) as $value) {
            $datas[] = $this->formatDatas($value);
        }

        return $datas;
    }

    /**
     * {@inheritdoc}
     */
    protected function formatDatas($datas)
    {
        return array_replace($datas, array(
            'text' => $datas['text'],
            'url'  => sprintf(static::TWEET_URL, $datas['user']['screen_name'], $datas['id_str']),
            'date' => new \Datetime($datas['created_at']),
        ));
    }
}
