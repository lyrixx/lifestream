<?php

namespace Lyrixx\Lifestream\Filter;

use Lyrixx\Lifestream\StatusInterface;

/**
 * Filter a StatusInterface
 */
interface FilterInterface
{

    /**
     * Filter a status
     *
     * @param StatusInterface $status A status
     *
     * @return boolean True if the status is valid
     */
    public function isValid(StatusInterface $status);
}
