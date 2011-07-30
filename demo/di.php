<?php

$c['httpClient'] = function ($c) {
    return new Buzz\Browser();
};

$c['rssProcessor'] = function($c) {
    return new Lifestream\Toolkit\FeedProcessor\RssProcessor($c['httpClient']);
};

$c['atomProcessor'] = function($c) {
    return new Lifestream\Toolkit\FeedProcessor\AtomProcessor($c['httpClient']);
};

$c['flickrProcessor'] = function($c) {
    return new Lifestream\Toolkit\FeedProcessor\FlickrProcessor($c['httpClient']);
};

$c['lastfmProcessor'] = function($c) {
    return new Lifestream\Toolkit\FeedProcessor\LastfmProcessor($c['httpClient']);
};

$c['atom'] = function($c){
    $atom = new Lifestream\Model\Service\Atom();
    $atom->setFeedUrl($c['atom.feed']);
    $atom->setFeedProcessor($c['atomProcessor']);
    if (isset($c['atom.filters'])){
        $twitter->setFilters($c['atom.filters']);
    }
    if (isset($c['atom.formatters'])){
        $twitter->setFormatters($c['atom.formatters']);
    }
    return $atom;
};

$c['rss'] = function($c){
    $rss = new Lifestream\Model\Service\Rss();
    $rss->setFeedUrl($c['rss.feed']);
    $rss->setFeedProcessor($c['rssProcessor']);
    if (isset($c['rss.filters'])){
        $rss->setFilters($c['rss.filters']);
    }
    if (isset($c['rss.formatters'])){
        $rss->setFormatters($c['rss.formatters']);
    }
    return $rss;
};

$c['twitter'] = function($c){
    $twitter = new Lifestream\Model\Service\Twitter();
    $twitter->setUsername($c['twitter.username']);
    $twitter->setFeedProcessor($c['rssProcessor']);
    if (isset($c['twitter.filters'])){
        $twitter->setFilters($c['twitter.filters']);
    }
    if (isset($c['twitter.formatters'])){
        $twitter->setFormatters($c['twitter.formatters']);
    }
    return $twitter;
};

$c['delicious'] = function($c){
    $delicious = new Lifestream\Model\Service\Delicious();
    $delicious->setUsername($c['delicious.username']);
    $delicious->setFeedProcessor($c['rssProcessor']);
    if (isset($c['delicious.filters'])){
        $delicious->setFilters($c['delicious.filters']);
    }
    if (isset($c['delicious.formatters'])){
        $delicious->setFormatters($c['delicious.formatters']);
    }
    return $delicious;
};

$c['lastfm'] = function($c){
    $lastfm = new Lifestream\Model\Service\Lastfm();
    $lastfm->setUsername($c['lastfm.username']);
    $lastfm->setFeedProcessor($c['lastfmProcessor']);
    if (isset($c['lastfm.filters'])){
        $lastfm->setFilters($c['lastfm.filters']);
    }
    if (isset($c['lastfm.formatters'])){
        $lastfm->setFormatters($c['lastfm.formatters']);
    }
    return $lastfm;
};

$c['github'] = function($c){
    $github = new Lifestream\Model\Service\Github();
    $github->setUsername($c['github.username']);
    $github->setFeedProcessor($c['atomProcessor']);
    if (isset($c['github.filters'])){
        $twitter->setFilters($c['github.filters']);
    }
    if (isset($c['github.formatters'])){
        $twitter->setFormatters($c['github.formatters']);
    }
    return $github;
};

$c['flickr'] = function($c){
    $github = new Lifestream\Model\Service\Flickr();
    $github->setUsername($c['flickr.username']);
    $github->setUserid($c['flickr.userid']);
    $github->setFeedProcessor($c['flickrProcessor']);
    if (isset($c['flickr.filters'])){
        $twitter->setFilters($c['flickr.filters']);
    }
    if (isset($c['flickr.formatters'])){
        $twitter->setFormatters($c['flickr.formatters']);
    }
    return $github;
};
