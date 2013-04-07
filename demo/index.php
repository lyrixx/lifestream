<?php

require_once(__DIR__ . '/../vendor/autoload.php');

$factory = Lyrixx\Lifestream\LifestreamFactory::createNewInstance();

function get_lifestream($service, $username /**, $someExtraArgs */)
{
    global $factory;

    $args = func_get_args();
    $service = array_shift($args);

    $lifestream = $factory
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
            echo '</li>';
        }
    echo '</ul>';
    echo '<hr>';
}

header('Content-Type: text/html; charset=utf-8');

echo '<h1>LifeStream</h1>';
display(get_lifestream('twitter', 'lyrixx'));
display(get_lifestream('github', 'lyrixx'));
display(get_lifestream('atom', 'http://feeds.feedburner.com/lyrixblog'));
display(get_lifestream('twitter_search', '#symfony'));
display(get_lifestream('twitter_list', 'futurecat', 'sensio'));
