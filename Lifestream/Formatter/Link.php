<?php

namespace Lifestream\Formatter;

use Lifestream\StatusInterface;

/**
 * @todo Test me
 */
class Link implements FormatterInterface
{

    public function format(StatusInterface $status)
    {
        return $status->setText(preg_replace("/(http:\/\/[^\s]+)/g", "<a href=\"$1\">$1</a>", $status()->getText()));
    }

}
