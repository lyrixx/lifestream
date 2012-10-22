<?php

namespace Lifestream\Filter;

/**
 *
 * @package Lifestream
 * @subpackage Filter
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
class Twitter implements FilterInterface
{

    public function isValid(StatusInterface $status)
    {
        return true
            && $this->filterMention($status)
        ;
    }

    /**
     * Remove all mention (eg : tweet with start with a '@')
     */
    public function filterMention(StatusInterface $status)
    {

        return 0 !== strpos($status->getText(), '@');
    }

}
