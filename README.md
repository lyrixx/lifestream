LifeStream
==========

Description
-----------

Lifestream is a stream manager for PHP.
Thanks this lib, you could easily fetch *last datas / status* from differents services :

-  twitter
-  flickr
-  delicious
-  lastfm (last artists)
-  rss feed
-  atom feed
-  github

Demo
------

Thanks to Pimple (a dependancy injection contrainer) and some dependancies already coded :

    $c['twitter.username'] = 'lyrixx';
    $twitter = $c['twitter'];

    echo $twitter->getServiceURL()

    foreach ($twitter->processStream()->getStream(10) as $status)
    {
        echo $status->text;
    }

For an extensive demo, look `demo/index.php` file

Filter
------

You could filter each status with filters :

-  remove direct mention from twitter stream
-  remove status wich contains specific word
-  ...

Formatter
---------

You could format each status with formatters :

-  Transform a text link into an html link
-  Transform an twitter mention into an html link
-  ...

Extensability
-------------

Of course it's possible to add new Service, Filter or Formatter

Requirements
------------

-  PHP 5.3
-  curl

Test
----

phpunit -c phpunit.xml
