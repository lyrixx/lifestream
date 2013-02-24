<?php

namespace Lyrixx\Lifestream\Formatter;

use Lyrixx\Lifestream\StatusInterface;

/**
 * Link formatter transforms all text/plain link
 * into a text/html link
 */
class Link implements FormatterInterface
{
    /**
     * {@inheritdoc}
     */
    public function format(StatusInterface $status)
    {
        return $status->setText(preg_replace(
            '/(https?:\/\/([^\s]+))/',
            '<a href="$1">$2</a>',
            $status->getText()
        ));
    }
}
