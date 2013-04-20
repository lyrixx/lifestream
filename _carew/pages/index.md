---
title :  Lifestream
tagline: A stream unifier for PHP
layout:  doc
---

[![Build Status](https://travis-ci.org/lyrixx/lifestream.png?branch=master)](https://travis-ci.org/lyrixx/lifestream)

Description
-----------

Lifestream is a **stream unifier for PHP**. Thanks to this lib, you could easily
fetch **last datas / status** from different services:

*  twitter (an account or a search or a list)
*  github
*  flickr
*  rss 2.0 feed
*  atom feed

Lifestream can also filter some status:

*  remove mention from twitter stream
*  remove RT from twitter stream
*  ...

And Lifestream can format each status with formatters:

*  Transform a text link into an html link
*  Transform an twitter mention into an html link
*  Transform an twitter hashtag into an html link
*  ...

Installation
------------

Add package to your `composer.json`:

    composer require lyrixx/lifestream:~1.1

Usage
-----

Lifestream library is ship with a factory to start very quickly:

    <?php

    $service = 'twitter';
    $username = 'lyrixx';

    $stream = Lyrixx\Lifestream\LifestreamFactory::createNewInstance()
        ->createLifestream($service, array($username))
        ->addFilter(new Lyrixx\Lifestream\Filter\TwitterMention())
        ->addFormatter(new Lyrixx\Lifestream\Formatter\Link())
        ->boot()
        ->getStream()
    ;

    foreach ($stream as $status) {
        echo $status.'<br />';
    }

For an extensive demo, look at
[demo/index.php](https://github.com/lyrixx/lifestream/blob/master/demo/index.php)
file.

### How does it work?

There are 3 different actors:

* A Service (`ServiceInterface`): This one will fetch data from a web server and
  extract datas

* A Lifestream (`Lifestream`): This one will use a service to retrieve data and then it will
  create a collection of status

* A Status (`StatusInterface`): This is one item among others. It could be a
  tweet,   ...

After this bootstrap, you can add `FormatterInterface` to format all status and
/ or add `FilterInterface` to filter un-wanted status.

So, from scratch:

    $service = new Lyrixx\Lifestream\Service\Twitter('lyrixx');

    $lifestream = Lyrixx\Lifestream\Lifestream($service);
    $lifestream->addFilter(new Lyrixx\Lifestream\Filter\TwitterMention());
    $lifestream->addFilter(new Lyrixx\Lifestream\Filter\TwitterRetweet());
    $lifestream->addFormatter(new Lyrixx\Lifestream\Formatter\Link());

    $lifestream->boot();
    $stream = $lifestream->getStream();

    foreach ($stream as $status) {
        echo $status.'<br />';
    }

### How to use the Aggregate service?

If you want to fetch and then merge few services, you can use the
`Aggregate` service. It will automatically sort all status by date.

**Note**: This Aggregate service will download all source in parallel for extra
speed!

    $service1 = new Lyrixx\Lifestream\Service\Twitter('lyrixx');
    $service2 = new Lyrixx\Lifestream\Service\TwitterSearch('#symfony2');

    $service = new Lyrixx\Lifestream\Service\Aggregate(array($service1, $service2));

    // ...

Integration
-----------

-  With [Silex]({{ relativeRoot }}/silex-provider.html)
-  With [Symfony2]({{ relativeRoot }}/symfony2-bundle.html)
