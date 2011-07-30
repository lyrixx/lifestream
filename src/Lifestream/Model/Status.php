<?php

namespace Lifestream\Model;

/**
 *
 * @package Lifestream
 * @subpackage Stream
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
class Status
{

    /**
     * @var string Text
     */
    public $text;
    /**
     * @var string Url
     */
    public $url;
    /**
     * @var string Date
     */
    public $date;
    /**
     * @var array Options
     */
    public $options;


    public function __toString()
    {
        return $this->text;
    }

}
