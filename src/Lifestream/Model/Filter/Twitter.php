<?php

namespace Lifestream\Model\Filter;

use Lifestream\Model\ServiceStream;

/**
 *
 * @package Lifestream
 * @subpackage Filter
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
class Twitter implements FilterInterface {

    private $stream;

    /**
     *
     * @inheritdoc
     */
    public function process() {
        $streamFiltered = array();
        $streamFiltered = $this->filterMention($this->stream);

        return $streamFiltered;
    }

    /**
     * Remove all mention (eg : tweet with start with a '@')
     *
     * @param array
     * @return array
     */
    public function filterMention(array $stream) {
        return array_filter($stream, function($status){
            return '@' != $status->text[0];
        });
    }

    /**
     *
     * @inheritdoc
     */
    public function setStream(array $stream) {
        $this->stream = $stream;

        return $this;
    }

}
