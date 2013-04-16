<?php

namespace Lyrixx\Lifestream\Status;

use Lyrixx\Lifestream\Status;

class AdvancedStatus extends Status
{
    private $username;
    private $fullname;
    private $pictureUrl;
    private $profileUrl;

    public function __construct(array $datas = array())
    {
        parent::__construct($datas);

        $datas = $this->getExtra();

        if (isset($datas['username'])) {
            $this->setUsername($datas['username']);
            unset($datas['username']);
        }
        if (isset($datas['fullname'])) {
            $this->setFullname($datas['fullname']);
            unset($datas['fullname']);
        }
        if (isset($datas['pictureUrl'])) {
            $this->setPictureUrl($datas['pictureUrl']);
            unset($datas['pictureUrl']);
        }
        if (isset($datas['profileUrl'])) {
            $this->setProfileUrl($datas['profileUrl']);
            unset($datas['profileUrl']);
        }

        $this->setExtra($datas);
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function getFullname()
    {
        return $this->fullname;
    }

    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getPictureUrl()
    {
        return $this->pictureUrl;
    }

    public function setPictureUrl($pictureUrl)
    {
        $this->pictureUrl = $pictureUrl;

        return $this;
    }

    public function getProfileUrl()
    {
        return $this->profileUrl;
    }

    public function setProfileUrl($profileUrl)
    {
        $this->profileUrl = $profileUrl;

        return $this;
    }
}
