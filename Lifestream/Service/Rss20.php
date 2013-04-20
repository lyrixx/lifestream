<?php

namespace Lyrixx\Lifestream\Service;

/**
 * Fetch RSS 2.0 feed
 */
class Rss20 extends AbstractService
{
    /**
     * {@inheritdoc}
     */
    protected function extractRawStatuses($datas)
    {
        $xml = new \SimpleXMLElement($datas);

        $datas = array();
        foreach ($xml->channel->item as $value) {
            $datas[] = $this->formatDatas($value);
        }

        return $datas;
    }

    /**
     * {@inheritdoc}
     */
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
