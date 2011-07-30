<?php

namespace Lifestream\Toolkit\FeedProcessor;

/**
 * Fetch datas from an url, manage them an return them
 *
 * @package Lifestream
 * @subpackage Feed
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
class RssProcessor extends BaseFeedProcessor
{

    /**
     *
     * @inheritdoc
     */
    protected function extractDatas(\SimpleXMLElement $xml)
    {
        $datas = array();
        foreach ($xml->channel->item as $value) {
            $datas[] = $value;
        }

        return $datas;
    }

    /**
     *
     * @inheritdoc
     */
    protected function formatDatas(array $datas)
    {
        $datasFormatted = array();
        foreach ($datas as $data) {
            $categories = array();
            foreach ($data->category as $category) {
                $categories[] = (string) $category;
            }
            $datasFormatted[] = array(
                'text'          => (string) $data->title,
                'url'           => (string) $data->link,
                'date'          => (string) $data->pubDate,
                'categories'    => $categories,
            );
        }

        return $datasFormatted;
    }

}
