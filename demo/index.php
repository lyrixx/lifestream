<?php

require_once(__DIR__ . '/../vendor/autoload.php');

function get_lifestream($service, $args)
{
    $lifestream = Lyrixx\Lifestream\LifestreamFactory::createNewInstance()
        ->createLifestream($service, $args)
        ->addFilter(new Lyrixx\Lifestream\Filter\TwitterMention())
        ->addFormatter(new Lyrixx\Lifestream\Formatter\Link())
    ;
    if ('twitter' === $service || 'twitter_search' === $service) {
        $lifestream
            ->addFormatter(new Lyrixx\Lifestream\Formatter\TwitterMention())
            ->addFormatter(new Lyrixx\Lifestream\Formatter\TwitterHashtag())
        ;
    }

    return $lifestream;
}

function display($lifestream)
{
    echo '<h2>';
        echo '<a href="' . $lifestream->getService()->getProfileUrl() . '">';
            echo $lifestream->getService()->getName();
        echo '</a>';
    echo '</h2>';
    echo '<ul>';
        foreach ($lifestream->boot()->getStream(8) as $status) {
            echo '<li>';
                echo $status;
                echo ' <a href="' . $status->getUrl() . '">';
                    echo '»';
                echo '</a>';
            echo '</li>';
        }
    echo '</ul>';
    echo '<hr>';
}

header('Content-Type: text/html; charset=utf-8');

echo '<h1>LifeStream</h1>';
$consumerKey = '...';
$consumerSecret = '...';
$accessToken = '...';
$accessTokenSecret = '...';
display(get_lifestream('github', array('lyrixx')));
display(get_lifestream('atom', array('http://feeds.feedburner.com/lyrixblog')));
display(get_lifestream('twitter', array($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret, 'lyrixx')));
display(get_lifestream('twitter_search', array($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret, '#symfony2')));
display(get_lifestream('twitter_list', array($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret, 'futurecat', 'sensio')));
