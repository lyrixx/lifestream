<?php

namespace Lifestream\Formatter;

use Lifestream\StatusInterface;

/**
 *
 * @package Lifestream
 * @subpackage Formatter
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
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
