<?php

namespace Lyrixx\Lifestream\Service;

use Guzzle\Http\Client;

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
     * @param string $search The twitter search
     * @param Client $client The client
     */
    public function __construct($search, Client $client = null)
    {
        $search = urlencode($search);
        $feedUrl = sprintf(self::FEED_URL, $search);
        $profileUrl = sprintf(self::PROFILE_URL, $search);

        parent::__construct($feedUrl, $profileUrl, $client);

        $this->setStatusClassname('Lyrixx\Lifestream\Status\AdvancedStatus');
    }

    /**
     * {@inheritdoc}
     */
    protected function formatDatas($datas)
    {
        $links = array();

        foreach ($datas->link as $link) {
            $link = (array) $link->attributes();
            $links[] = $link['@attributes'];
        }

        $author = (array) $datas->author;
        preg_match('/(\w+) \((.*)\)/', $author['name'], $matches);

        return array_replace(parent::formatDatas($datas), array(
            'username' => $matches[1],
            'fullname' => $matches[2],
            'pictureUrl' => $links[1]['href'],
            'profileUrl' => $author['uri'],
            'links' => $links,
            'author' => $author,
        ));
    }
}
