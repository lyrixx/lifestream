<?php

namespace Lifestream\Toolkit\FeedProcessor;

/**
 * Fetch datas from an url, manage them an return them
 *
 * @package Lifestream
 * @subpackage Feed
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
class AtomProcessor extends BaseFeedProcessor
{

    /**
     *
     * @inheritdoc
     */
    protected function extractDatas(\SimpleXMLElement $xml)
    {
        $datas = array();
        foreach ($xml->entry as $value) {
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
                'text'      => (string) $data->title,
                'url'       => (string) $data->link['href'],
                'date'      => (string) $data->published,
                'content'   => (string) $data->content,
            );
        }

        return $datasFormatted;
    }

}
