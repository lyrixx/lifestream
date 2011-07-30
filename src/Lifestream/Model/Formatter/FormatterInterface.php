<?php

namespace Lifestream\Model\Formatter;

use Lifestream\Model\ServiceStream;

/**
 *
 * @package Lifestream
 * @subpackage Formatter
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
interface FormatterInterface
{

    /**
     * Run all formatters;
     *
     * @return array Stream Filtered
     */
    public function process();

    /**
     * Set a stream to be filtered
     *
     * @param array Stream
     */
    public function setStream(array $stream);

}
