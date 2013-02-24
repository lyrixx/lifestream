<?php

namespace Lyrixx\Lifestream\Filter;

use Lyrixx\Lifestream\StatusInterface;

/**
 * TwitterMention
 */
class TwitterMention implements FilterInterface
{
    /**
     * {@inheritdoc}
     */
    public function isValid(StatusInterface $status)
    {
        return 0 !== strpos($status->getText(), '@');
    }
}
