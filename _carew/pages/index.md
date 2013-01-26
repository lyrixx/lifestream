---
title :  Lifestream
tagline: A stream unifier for PHP
layout:  doc
---

[![Build Status](https://secure.travis-ci.org/lyrixx/lifestream.png)](http://travis-ci.org/lyrixx/lifestream)

Description
-----------

Lifestream is a stream unifier for PHP.
Thanks to this lib, you could easily fetch *last datas / status*
from differents services:

-  twitter
-  flickr
-  rss feed
-  atom feed
-  github

Usage
-----

    php
    // $service = 'twitter';
    // $username = 'lyrixx';

    $browser = new Buzz\Browser(new Buzz\Client\Curl())
    $factory = new Lyrixx\Lifestream\LifestreamFactory($browser);

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

For an extensive demo, look
[demo/index.php](https://github.com/lyrixx/lifestream/blob/master/demo/index.php)
file.

Filter
------

You could filter each status with filters:

-  remove direct mention from twitter stream
-  remove RT from twitter stream
-  remove status wich contains specific word
-  ...

Formatter
---------

You could format each status with formatters:

-  Transform a text link into an html link
-  Transform an twitter mention into an html link
-  ...

Integration
-----------

-  With [Silex]({{ relativeRoot }}/silex-provider.html)

Extensability
-------------

Of course it's possible to add new Service, Filter or Formatter.

Requirements
------------

-  PHP 5.3
