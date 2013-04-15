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
        return $status->setText(preg_replace_callback(
            '/(?P<all>(?P<href>href=("|\'))?(?P<link>https?:\/\/(?P<name>[^\s]+)))/',
            function($matches) {
                if ($matches['href']) {
                    return $matches['all'];
                }
                return sprintf('<a href="%s">%s</a>', $matches['link'], $matches['name']);
            },
            $status->getText()
        ));
    }
}
