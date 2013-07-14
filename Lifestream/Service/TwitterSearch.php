<?php

namespace Lyrixx\Lifestream\Service;

use Guzzle\Http\Client;
use Lyrixx\Twitter\Twitter as TwitterSdk;

/**
 * Fetch twitter feed
 */
class TwitterSearch extends AbstractService
{
    const PROFILE_URL = 'https://twitter.com/%s';
    const SEARCH_URL = 'https://twitter.com/search?q=%s';
    const TWEET_URL = 'https://twitter.com/%s/status/%s';

    protected $twitterSdk;
    private $options;

    /**
     * Constructor
     *
     * @param string     $consumerKey
     * @param string     $consumerSecret
     * @param string     $accessToken
     * @param string     $accessTokenSecret
     * @param string     $search
     * @param array      $options
     * @param TwitterSdk $twitterSdk
     */
    public function __construct($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret, $search, array $options = array(), TwitterSdk $twitterSdk = null)
    {
        $search = urlencode($search);

        parent::__construct(sprintf(self::SEARCH_URL, $search));

        $this->options = array_replace(array(
            'q' => $search,
            'result_type' => 'recent',
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
        return $this->twitterSdk->createRequest('GET', 'search/tweets', $this->options);
    }

    /**
     * {@inheritdoc}
     */
    protected function extractRawStatuses($dataTmp)
    {
        $dataTmp = json_decode((string) $dataTmp, true);
        $dataTmp = $dataTmp['statuses'];

        $data = array();
        foreach ($dataTmp as $value) {
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
