<?php

namespace Lifestream\Toolkit\FeedProcessor;

/**
 * Fetch datas from an url, manage them an return them
 *
 * @package Lifestream
 * @subpackage Feed
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
class FlickrProcessor extends AtomProcessor
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
            $datasFormatted[] = array(
                'text'          => (string) $data->title,
                'url'           => (string) $data->link,
                'date'          => (string) $data->pubDate,
                'author'        => (string) $data->author,
                'description'   => (string) $data->description,
                'guid'          => (string) $data->guid,
            );
        }

        return $datasFormatted;
    }

}
