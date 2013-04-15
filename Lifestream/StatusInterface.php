<?php

namespace Lyrixx\Lifestream;

/**
 * Describe a status
 */
interface StatusInterface
{
    /**
     * @return string The text
     */
    public function getText();

    /**
     * @param String $text The text
     */
    public function setText($text);

    /**
     * @return string The url to the status
     */
    public function getUrl();

    /**
     * @param string $url The url to the status
     */
    public function setUrl($url);

    /**
     * @return \Datetime The date
     */
    public function getDate();

    /**
     * @param \Datetime $date The date
     */
    public function setDate($date);

    /**
     * @return array The extra
     */
    public function getExtra();

    /**
     * @param array $extra The extra
     */
    public function setExtra($extra);

    /**
     * @return string
     */
    public function __toString();

}
