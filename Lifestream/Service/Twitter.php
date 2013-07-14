<?php

namespace Lyrixx\Lifestream\Service;

use Lyrixx\Twitter\Twitter as TwitterSdk;

/**
 * Fetch twitter feed
 */
class Twitter extends TwitterSearch
{
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
    public function __construct($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret, $username, array $options = array(), TwitterSdk $twitterSdk = null)
    {
        $username = 'from:@'.$username;
        $options = array_replace(array(
            'q' => $username,
        ), $options);

        parent::__construct($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret, $username, $options, $twitterSdk);
    }
}
