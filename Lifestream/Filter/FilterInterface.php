<?php

namespace Lifestream\Filter;

use Lifestream\StatusInterface;

/**
 *
 * @package Lifestream
 * @subpackage Filter
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
interface FilterInterface {

    /**
     * Filter a status
     *
     * @param StatusInterface $status A status
     *
     * @return boolean True if the status is valid
     */
    public function isValid(StatusInterface $status);
}
