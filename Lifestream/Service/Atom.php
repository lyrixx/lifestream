<?php

namespace Lifestream\Service;

/**
 * Fetch an atom feed
 */
class Atom extends AbstractFeed
{
    /**
     * {@inheritdoc}
     */
    protected function extractDatas(\SimpleXMLElement $xml)
    {
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
