<?php

namespace Lifestream\Service;

class Atom extends AbstractFeed
{

    protected function extractDatas(\SimpleXMLElement $xml)
    {
        $datas = array();
        foreach ($xml->entry as $value) {
            $datas[] = $this->formatDatas($value);
        }

        return $datas;
    }

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
