---
title:      "Symfony2 Bundle"
tagline:    "Symfony2 Bundle for Lifestream"
layout:     doc
navigation: main
---

Installation
------------

#### Add package to your composer.json:

    composer require lyrixx/lifestream-bundle:~1.0

#### Register the bundle in the kernel:

    // app/AppKernel.php
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                // ...
                new Lyrixx\Bundle\LifestreamBundle\LyrixxLifestreamBundle(),
                // ..
            );
            // ...
        }
    }

### Configuration:

If you want to have a service which will fetch all tweets containing #symfony2
hashtag, register the following configuration in `app/config/config.yml`

    lyrixx_lifestream:
        lifestream:
            twitter_symfony:
                service: twitter_search
                args:
                    - "#symfony2"

You can add some filters and/or formatters to a lifestream:

    lyrixx_lifestream:
        lifestream:
            twitter_symfony:
                service: twitter_search
                args:
                    - "#symfony2"
                formatters:
                    - link
                    - twitter_hashtag
                    - twitter_mention
                filters:
                    - twitter_mention

You can find the list of service, filter, formatter available in `services.xml`.

You can also add some formatters or filters to all services:

    lyrixx_lifestream:
        formatters:
            - link
            - twitter_hashtag
            - twitter_mention
        filters:
            - twitter_mention
        lifestream:
            twitter_symfony:
                service: twitter_search
                args:
                    - "#symfony2"
            twitter_silex:
                service: twitter_search
                args:
                    - "#silex"

Usage
-----

    // From a controller:
    $stream = $this->get('lyrixx.lifestream.my.twitter_symfony')->boot()->getStream();

Extends
-------

You can add new services, formatters or filter by creating a new Symfony2
service and then by tagging it **with an alias**:

* `lyrixx.lifestream.service` for a new service
* `lyrixx.lifestream.formatter` for a new formatter
* `lyrixx.lifestream.filter` for a new filter

Some samples:

        <service id="lyrixx.lifestream.service.atom" class="%lyrixx.lifestream.service.atom.class%" abstract="true" public="false">
            <argument /><!-- username -->
            <argument type="service" id="lyrixx.lifestream.client" />
            <tag name="lyrixx.lifestream.service" alias="atom" />
        </service>

        <service id="lyrixx.lifestream.formatter.twitter_mention" class="%lyrixx.lifestream.formatter.twitter_mention.class%" public="false">
            <tag name="lyrixx.lifestream.formatter" alias="twitter_mention" />
        </service>

        <service id="lyrixx.lifestream.filter.twitter_retweet" class="%lyrixx.lifestream.filter.twitter_retweet.class%" public="false">
            <tag name="lyrixx.lifestream.filter" alias="twitter_retweet" />
        </service>

And then you can use them with the alias.
