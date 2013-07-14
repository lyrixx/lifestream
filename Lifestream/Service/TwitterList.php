<?php

namespace Lyrixx\Lifestream\Service;

use Guzzle\Http\Client;
use Lyrixx\Twitter\Twitter as TwitterSdk;

/**
 * Fetch twitter list
 */
class TwitterList extends AbstractService
{
    const PROFILE_URL = 'https://twitter.com/%s';
    const FEED_URL    = 'https://twitter.com/%s/%s';
    const TWEET_URL   = 'https://twitter.com/%s/statuses/%s';

    private $twitterSdk;
    private $options;

    /**
     * Constructor
     *
     * @param string     $consumerKey
     * @param string     $consumerSecret
     * @param string     $accessToken
     * @param string     $accessTokenSecret
     * @param string     $username
     * @param string     $list
     * @param array      $options
     * @param TwitterSdk $twitterSdk
     */
    public function __construct($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret, $username, $list, array $options = array(), TwitterSdk $twitterSdk = null)
    {
        parent::__construct(sprintf(self::FEED_URL, $username, $list));

       $this->options = array_replace(array(
            'slug' => $list,
            'owner_screen_name' => $username,
        ), $options);

        $this->twitterSdk = $twitterSdk ?: new TwitterSdk($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

        $this->setStatusClassname('Lyrixx\Lifestream\Status\AdvancedStatus');
    }

    public function setClient(Client $client)
    {
        $this->twitterSdk->setClient($client);
    }

    public function prepareRequest()
    {
        return $this->twitterSdk->createRequest('GET', 'lists/statuses', $this->options);
    }

    /**
     * {@inheritdoc}
     */
    protected function extractRawStatuses($dataTmp)
    {
        $data = array();
        foreach (json_decode((string) $dataTmp, true) as $value) {
            $data[] = $this->formatDatas($value);
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    protected function formatDatas($data)
    {
        return array(
            'text' => $data['text'],
            'url'  => sprintf(static::TWEET_URL, $data['user']['screen_name'], $data['id_str']),
            'date' => new \Datetime($data['created_at']),
            'username' => $data['user']['screen_name'],
            'fullname' => $data['user']['name'],
            'pictureUrl' => $data['user']['profile_image_url'],
            'profileUrl' => sprintf(static::PROFILE_URL, $data['user']['screen_name']),
        );
    }
}
