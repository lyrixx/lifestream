<?php

namespace Lifestream;

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
     * @return array The options
     */
    public function getOptions();

    /**
     * @param array $options The options
     */
    public function setOptions($options);

    /**
     * @return string
     */
    public function __toString();

}
