---
layout: page
title : Lifestream
tagline: A stream unifier for PHP
---
{% include JB/setup %}

[**See project on github**](https://github.com/lyrixx/lifestream)
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

Demo
------

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

Extensability
-------------

Of course it's possible to add new Service, Filter or Formatter.

Requirements
------------

-  PHP 5.3

Licence
-------

    Copyright (C) 2012 Grégoire Pineau

    Permission is hereby granted, free of charge, to any person obtaining a
    copy of this software and associated documentation files (the "Software"),
    to deal in the Software without restriction, including without limitation
    the rights to use, copy, modify, merge, publish, distribute, sublicense,
    and/or sell copies of the Software, and to permit persons to whom the
    Software is furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
    FROM, OUTOF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
    IN THE SOFTWARE.
