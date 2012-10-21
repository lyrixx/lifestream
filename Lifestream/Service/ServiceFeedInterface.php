<?php

namespace Lifestream\Service;

interface ServiceFeedInterface extends ServiceInterface
{

    public function setBrowser($browser);

    public function getFeedUrl();

    public function setFeedUrl($feedUrl);

    public function getProfileUrl();

    public function setProfileUrl($profileUrl);

}
