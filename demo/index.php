<?php
// Add the autoloader
require_once(__DIR__ . '/autoload.php');

// Add a small Dependency Injector
require_once(__DIR__ . '/Pimple/lib/Pimple.php');
// Init it
$c = new Pimple();
// Load DI default values
require_once(__DIR__ . '/di.php');

// Define some username
$c['twitter.username']      = 'lyrixx';
$c['delicious.username']    = 'lyrixx86';
$c['rss.feed']              = 'http://feeds2.feedburner.com/lyrixblog';
$c['lastfm.username']       = 'lyrix86';
$c['github.username']       = 'lyrixx';
$c['flickr.username']       = 'xavierbriand';
$c['flickr.userid']         = '34871318';

// Define Some filters
$c['filters.twitter'] = function($c){
    return new Lifestream\Model\Filter\Twitter();
};
// Define some twitter filters
$c['twitter.filters'] = function($c){
    return array($c['filters.twitter']);

};

// Define Some formatters
$c['formatter.link'] = function($c){
    return new Lifestream\Model\Formatter\Link();
};
// Define Some twitter formatters
$c['twitter.formatters'] = function($c){
    return array($c['formatter.link']);
};


// Define default displayer
function displayStatus($status) {
    echo $status->text;
}

function displayStream($stream) {
    echo '<ul>';
    foreach ($stream as $status) {
        echo '<li>';
        displayStatus($status);
        echo '</li>';
    }
    echo '</ul>';
}
?>

<h1>LifeStream</h1>
<?php

$twitter = $c['twitter'];
echo '<h2><a href="' . $twitter->getServiceURL() . '">Twitter</a></h2>';
displayStream($twitter->processFeed()->getStream(10));
echo '<hr>';

$twitter->setUsername('fabpot');
echo '<h2><a href="' . $twitter->getServiceURL() . '">Twitter</a></h2>';
displayStream($twitter->processFeed()->getStream(10));
echo '<hr>';

$delicious = $c['delicious'];
echo '<h2><a href="'.$delicious->getServiceURL().'">Delicious</a></h2>';
displayStream($delicious->processFeed()->getStream(10));
echo '<hr>';

$rss = $c['rss'];
echo '<h2><a href="'.$rss->getServiceURL().'">RSS</a></h2>';
displayStream($rss->processFeed()->getStream(10));
echo '<hr>';

$lastfm = $c['lastfm'];
echo '<h2><a href="' . $lastfm->getServiceURL() . '">LastFM</a></h2>';
displayStream($lastfm->processFeed()->getStream(10));
echo '<hr>';

$github = $c['github'];
echo '<h2><a href="'.$github->getServiceURL().'">Github</a></h2>';
displayStream($github->processFeed()->getStream(10));
echo '<hr>';

$flickr = $c['flickr'];
echo '<h2><a href="'.$flickr->getServiceURL().'">Flickr</a></h2>';
displayStream($flickr->processFeed()->getStream(10));
echo '<hr>';
