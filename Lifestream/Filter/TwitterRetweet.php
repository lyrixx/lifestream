<?php

namespace Lyrixx\Lifestream\Filter;

use Lyrixx\Lifestream\StatusInterface;

/**
 * TwitterRetweet
 */
class TwitterRetweet implements FilterInterface
{
    /**
     * {@inheritdoc}
     */
    public function isValid(StatusInterface $status)
    {
        return 0 !== strpos($status->getText(), 'RT @');
    }
}
