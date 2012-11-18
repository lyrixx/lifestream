<?php
// Add the autoloader
require_once(__DIR__ . '/../vendor/autoload.php');

// Add a small Dependency Injector
$c = new Pimple();

// Load DIC default values

$c['browser'] = $c->share(function () {
    return new Buzz\Browser(new Buzz\Client\Curl());
});

use Lyrixx\Lifestream;

$c['lifestream.factory'] = $c->protect(function($service, $id) use($c) {
    $lifestream = new Lifestream\Lifestream($service);

    if (isset($c['my_lifestream.'.$id.'.filters'])) {
        $lifestream->setFilters($c['my_lifestream'.$id.'.filters']);
    }
    if (isset($c['my_lifestream.'.$id.'.formatters'])) {
        $lifestream->setFormatters($c['my_lifestream'.$id.'.formatters']);
    }

    return $c['my_lifestream.'.$id] = $lifestream;

});

$c['lifestream.display'] = $c->protect(function($lifestream, $title = null) {
    echo '<h2>';
        echo '<a href="' . $lifestream->getService()->getProfileUrl() . '">';
            echo $title ?: $lifestream->getService()->getName();
        echo '</a>';
    echo '</h2>';
    echo '<ul>';
        foreach ($lifestream->boot()->getStream() as $status) {
            echo '<li>';
                echo $status;
            echo '</li>';
        }
    echo '</ul>';
    echo '<hr>';
});

// Config:
$lsf = $c['lifestream.factory'];

use Lyrixx\Lifestream\Service;

$lsf(new Service\Twitter('lyrixx', $c['browser']), 'twitter.lyrixx');
$lsf(new Service\Github('lyrixx', $c['browser']), 'github.lyrixx');
$lsf(new Service\Rss20('http://feeds2.feedburner.com/lyrixblog', null, $c['browser']), 'rss.lyrixx');
$lsf(new Service\FlickrRss20('34871318', 'xavierbriand', $c['browser']), 'flicker.xavierbriand');

// $c['delicious.username']    = 'lyrixx86';
// $c['lastfm.username']       = 'lyrix86';

echo '<h1>LifeStream</h1>';

$lsd = $c['lifestream.display'];
$lsd($c['my_lifestream.twitter.lyrixx']);
$lsd($c['my_lifestream.github.lyrixx']);
$lsd($c['my_lifestream.rss.lyrixx']);
$lsd($c['my_lifestream.flicker.xavierbriand']);
