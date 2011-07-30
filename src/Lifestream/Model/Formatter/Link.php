<?php

namespace Lifestream\Model\Formatter;

use Lifestream\Model\ServiceStream;

/**
 * @package Lifestream
 * @subpackage Formatter
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
class Link implements FormatterInterface
{

    private $stream;

    /**
     *
     * @inheritdoc
     */
    public function process()
    {
        $streamFormatted = array();
        $streamFormatted = $this->formatLink($this->stream);

        return $streamFormatted;
    }

    /**
     * Make a real html link
     *
     * @return array
     */
    public function formatLink(array $stream)
    {
        return array_map(function($value) {
            $value->text = preg_replace("/(http:\/\/[^\s]+)/", "<a href=\"$1\">$1</a>", $value->text);
            return $value;
        }, $stream);
    }

    /**
     *
     * @inheritdoc
     */
    public function setStream(array $stream)
    {
        $this->stream = $stream;

        return $this;
    }

}
