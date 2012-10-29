<?php

namespace Lifestream\Filter;

use Lifestream\StatusInterface;

/**
 * @todo Test me
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
