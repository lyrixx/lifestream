<?php

namespace Lyrixx\Lifestream\Service;

/**
 * Fetch an atom feed
 */
class Atom extends AbstractService
{
    /**
     * {@inheritdoc}
     */
    protected function extractRawStatuses($datas)
    {
        $xml = new \SimpleXMLElement($datas);

        $datas = array();
        foreach ($xml->entry as $value) {
            $datas[] = $this->formatDatas($value);
        }

        return $datas;
    }

    /**
     * {@inheritdoc}
     */
    protected function formatDatas($datas)
    {
        $link = $datas->link;

        return array(
            'text' => (string) $datas->title,
            'url'  => (string) $link['href'],
            'date' => new \Datetime($datas->updated),
        );
    }

}
