<?php

namespace Lifestream\Filter;

use Lifestream\StatusInterface;

/**
 * TwitterFilter
 *
 * Invalidate all reply
 *
 * @todo add RT filter
 * @todo Support filter configuration
 */
class Twitter implements FilterInterface
{

    public function isValid(StatusInterface $status)
    {
        return true
            && $this->filterReply($status)
        ;
    }

    /**
     * Remove all mention (eg : tweet with start with a '@')
     */
    private function filterReply(StatusInterface $status)
    {
        return 0 !== strpos($status->getText(), '@');
    }

}
