<?php

namespace Lifestream\Service;

class Rss20 extends AbstractFeed
{

    protected function extractDatas(\SimpleXMLElement $xml)
    {
        $datas = array();
        foreach ($xml->channel->item as $value) {
            $datas[] = $this->formatDatas($value);
        }

        return $datas;
    }

    protected function formatDatas($datas)
    {
        $categories = array();
        foreach ($datas->category as $category) {
            $categories[] = (string) $category;
        }

        return array(
            'text'        => (string) $datas->title,
            'description' => (string) $datas->description,
            'url'         => (string) $datas->link,
            'date'        => new \Datetime($datas->pubDate),
            'categories'  => $categories,
        );
    }

}
