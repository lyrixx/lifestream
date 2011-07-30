<?php

namespace Lifestream\Model\Filter;

use Lifestream\Model\ServiceStream;

/**
 *
 * @package Lifestream
 * @subpackage Filter
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
interface FilterInterface {

	/**
     * Run all filters
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
