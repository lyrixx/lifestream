<?php

$c['browser'] = $c->share(function () {
    return new Buzz\Browser();
});

$c['lifestream.factory'] = $c->protect(function($service, $id) {
    $lifestream = new Lifestream\Lifestream($service);


    if (isset($c['lifestream'.$id.'.filters'])) {
        $lifestream->setFilters($c['lifestream'.$id.'.filters']);
    }
    if (isset($c[$id.'.formatters'])) {
        $lifestream->setFormatters($c['lifestream'.$id.'.formatters']);
    }

    return $lifestream;

});
