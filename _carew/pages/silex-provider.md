---
title:      "Silex Provider"
tagline:    "Silex service provider for Lifestream"
layout:     doc
navigation: main
---

Installation
------------

#### Add package to your composer.json:

    composer require lyrixx/lifestream-silex-prodvider:~1.0

#### Load extensions:

    use Silex\Application;
    use Lyrixx\Lifestream\Silex\Provider\LifestreamServiceProvider;

    $app = new Application();
    $app->register(new LifestreamServiceProvider());


Usage
-----

    $service = 'twitter';
    $username = 'lyrixx';

    $status = $app['lifestream.factory']
        ->createLifestream($service, array($username))
        ->addFilter(new \Lyrixx\Lifestream\Filter\TwitterMention())
        ->addFormatter(new \Lyrixx\Lifestream\Formatter\Link())
        ->boot()
        ->getStream()
    ;
    foreach ($status as $key => $value) {
        echo $value.'<br />';
    }
