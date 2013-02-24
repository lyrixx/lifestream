<?php

require_once(__DIR__ . '/../vendor/autoload.php');

$factory = new Lyrixx\Lifestream\LifestreamFactory();

function get_lifestream($service, $username) {
    global $factory;

    return $factory
        ->createLifestream($service, $username)
        ->addFilter(new Lyrixx\Lifestream\Filter\Twitter(Lyrixx\Lifestream\Filter\Twitter::FILTER_REPLY))
        ->addFormatter(new Lyrixx\Lifestream\Formatter\Link())
    ;
}

function display($lifestream, $title = null) {
    echo '<h2>';
        echo '<a href="' . $lifestream->getService()->getProfileUrl() . '">';
            echo $title ?: $lifestream->getService()->getName();
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

echo '<h1>LifeStream</h1>';
display(get_lifestream('twitter', 'lyrixx'));
display(get_lifestream('github', 'lyrixx'));
display(get_lifestream('atom', 'http://feeds.feedburner.com/lyrixblog'));
