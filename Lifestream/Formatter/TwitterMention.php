<?php

namespace Lyrixx\Lifestream\Formatter;

use Lyrixx\Lifestream\StatusInterface;

/**
 * Twitter formatter transforms all mentions into a text/html link
 */
class TwitterMention implements FormatterInterface
{
    const PROFILE_URL = 'https://twitter.com/%s';

    /**
     * {@inheritdoc}
     */
    public function format(StatusInterface $status)
    {
        return $status->setText(preg_replace(
            '/@(\w+)/',
            sprintf('<a href="'.self::PROFILE_URL.'">@%s</a>', '$1', '$1'),
            $status->getText()
        ));
    }
}
