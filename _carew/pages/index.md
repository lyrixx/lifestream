---
title :  Lifestream
tagline: A stream unifier for PHP
layout:  doc
---

[![Build Status](https://secure.travis-ci.org/lyrixx/lifestream.png)](http://travis-ci.org/lyrixx/lifestream)

Description
-----------

Lifestream is a stream unifier for PHP. Thanks to this lib, you could easily
fetch *last datas / status* from differents services:

-  twitter
-  flickr
-  rss feed
-  atom feed
-  github

Installation
------------

Add package to your `composer.json`:

    composer require lyrixx/lifestream:~1.0

Usage
-----

    <?php

    $service = 'twitter';
    $username = 'lyrixx';

    $status = Lyrixx\Lifestream\LifestreamFactory::createNewInstance()
        ->createLifestream($service, array($username))
        ->addFilter(new Lyrixx\Lifestream\Filter\TwitterMention())
        ->addFormatter(new Lyrixx\Lifestream\Formatter\Link())
        ->boot()
        ->getStream()
    ;

    foreach ($status as $key => $value) {
        echo $value.'<br />';
    }

For an extensive demo, look at
[demo/index.php](https://github.com/lyrixx/lifestream/blob/master/demo/index.php)
file.

Filter
------

You could filter each status with some filters:

-  remove mention from twitter stream
-  remove RT from twitter stream
-  ...

Formatter
---------

You could format each status with formatters:

-  Transform a text link into an html link
-  Transform an twitter mention into an html link
-  Transform an twitter hashtag into an html link
-  ...

Integration
-----------

-  With [Silex]({{ relativeRoot }}/silex-provider.html)
-  With [Symfony2]({{ relativeRoot }}/symfony2-bundle.html)
