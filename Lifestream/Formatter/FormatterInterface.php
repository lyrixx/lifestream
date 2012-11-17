<?php

namespace Lifestream\Formatter;

use Lifestream\StatusInterface;

/**
 * Format a Status
 */
interface FormatterInterface
{

    /**
     * Return a formatted StatusInterface;
     *
     * @param StatusInterface $status A StatusInterface
     *
     * @return StatusInterface A formatted StatusInterface
     */
    public function format(StatusInterface $status);
}
