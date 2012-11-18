<?php
// Add the autoloader
require_once(__DIR__ . '/../vendor/autoload.php');

$browser = new Buzz\Browser(new Buzz\Client\Curl());
$factory = new Lyrixx\Lifestream\LifestreamFactory($browser);

function get_lifestream($service, $username) {
    global $browser, $factory;

    return $factory
        ->createLifestream($service, $username)
        ->addFilter(new \Lyrixx\Lifestream\Filter\Twitter())
        ->addFormatter(new \Lyrixx\Lifestream\Formatter\Link())
    ;
}

function display($lifestream, $title = null) {
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
}


echo '<h1>LifeStream</h1>';
display(get_lifestream('twitter', 'lyrixx'));
display(get_lifestream('github', 'lyrixx'));
