<?php

namespace Lifestream\Formatter;

use Lifestream\StatusInterface;

/**
 * Link formatter transforms all text/plain link
 * into a text/html link
 *
 * @todo Support https formatter
 * @todo Support mailto formatter
 * @todo Support formatter configuration
 */
class Link implements FormatterInterface
{

    public function format(StatusInterface $status)
    {
        return $this->formatHttpLink($status);
    }

    private function formatHttpLink(StatusInterface $status)
    {
        return $status->setText(preg_replace(
            "/(http:\/\/([^\s]+))/",
            "<a href=\"$1\">$2</a>",
            $status->getText()
        ));
    }

}
