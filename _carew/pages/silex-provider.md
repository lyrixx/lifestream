---
title:      "Silex Provider"
tagline:    "Silex service provider for Lifestream"
layout:     doc
navigation: main
---

Installation
------------

#### Add package to your composer.json:

    bash
    composer require lyrixx/lifestream-silex-prodvider:dev-master

#### Load extensions:


    php
    use Silex\Application;

    use MarcW\Silex\Provider\BuzzServiceProvider;
    use Lyrixx\Lifestream\Silex\Provider\LifestreamServiceProvider;

    $app = new Application();
    $app->register(new BuzzServiceProvider());
    $app->register(new LifestreamServiceProvider());

**Note:** `LifestreamServiceProvider` have a dependancy
on `MarcW\Silex\Provider\BuzzServiceProvider`.

Usage
-----

    php
    // $service = 'twitter';
    // $username = 'lyrixx';

    $factory = $app['lifestream.factory'];

    // Throw a 404 if the service in not available
    $app['lifestream.check_service']($service);

    $status = $factory
        ->createLifestream($service, $username)
        ->addFilter(new \Lyrixx\Lifestream\Filter\Twitter())
        ->addFormatter(new \Lyrixx\Lifestream\Formatter\Link())
        ->boot()
        ->getStream()
    ;
    foreach ($status as $key => $value) {
        echo $value;
    }
