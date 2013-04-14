<?php

namespace Lyrixx\Lifestream\Service;

/**
 * Fetch twitter search feed
 */
class TwitterSearch extends Atom
{
    const FEED_URL    = 'https://search.twitter.com/search.atom?q=%s&include_entities=true';
    const PROFILE_URL = 'https://twitter.com/search/realtime?q=%s';

    /**
     * Constructor
     *
     * @param [type] $client The client
     * @param string $search The twitter search
     */
    public function __construct($search, $client = null)
    {
        $search = urlencode($search);
        $feedUrl = sprintf(self::FEED_URL, $search);
        $profileUrl = sprintf(self::PROFILE_URL, $search);

        parent::__construct($feedUrl, $profileUrl, $client);
    }

    /**
     * {@inheritdoc}
     */
    protected function formatDatas($datas)
    {
        return array_replace(parent::formatDatas($datas), array(
            'author' => (array) $datas->author,
        ));
    }
}
