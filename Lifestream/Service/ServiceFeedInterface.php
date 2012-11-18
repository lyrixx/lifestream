<?php

namespace Lyrixx\Lifestream\Service;

/**
 * ServiceFeedInterface will be in charges to
 * fetch remotes (over http) datas,
 * and convert each status to a StatusInterface object.
 */
interface ServiceFeedInterface extends ServiceInterface
{

    /**
     * Set a browser
     *
     * @todo Use a typint here
     *
     * @param [type] $browser A browser
     */
    public function setBrowser($browser);

    /**
     * Return the full url to the feed.
     *
     * @return string The feed Url
     */
    public function getFeedUrl();

    /**
     * Return the full url to the profile
     *
     * @return string The profile url
     */
    public function getProfileUrl();

}
