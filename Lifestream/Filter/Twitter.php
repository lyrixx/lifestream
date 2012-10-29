<?php

namespace Lifestream\Filter;

/**
 * @todo Test me
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
