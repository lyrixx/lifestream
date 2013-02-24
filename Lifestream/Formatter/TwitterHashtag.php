<?php

namespace Lyrixx\Lifestream\Formatter;

use Lyrixx\Lifestream\StatusInterface;

/**
 * Twitter formatter transforms all hashtags into a text/html link
 */
class TwitterHashtag implements FormatterInterface
{
    const HASHTAG_URL = 'https://twitter.com/search?q=%%23%s';

    /**
     * {@inheritdoc}
     */
    public function format(StatusInterface $status)
    {
        return $status->setText(preg_replace(
            '/#(\w+)/',
            sprintf('<a href="'.self::HASHTAG_URL.'">#%s</a>', '$1', '$1'),
            $status->getText()
        ));
    }
}
