<?php

namespace Lifestream\Formatter;

use Lifestream\StatusInterface;

/**
 * @todo Test me
 */
interface FormatterInterface
{

    /**
     * Return a formatted StatusInterface;
     *
     * @return StatusInterface A formatted StatusInterface
     */
    public function format(StatusInterface $status);
}
