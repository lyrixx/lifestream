LifeStream
==========

[![Build Status](https://secure.travis-ci.org/lyrixx/lifestream.png)](http://travis-ci.org/lyrixx/lifestream)

Description
-----------

Lifestream is a stream manager/unifier for PHP.
Thanks this lib, you could easily fetch *last datas / status* from differents services :

-  twitter
-  flickr
-  rss feed
-  atom feed
-  github

Demo
------

For an extensive demo, look `demo/index.php` file

Filter
------

You could filter each status with filters :

-  remove direct mention from twitter stream
-  remove RT from twitter stream
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
