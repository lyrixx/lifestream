<?php

namespace Lifestream\Toolkit\FeedProcessor;

/**
 * Fetch datas from an url, manage them an return them
 *
 * @package Lifestream
 * @subpackage Feed
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
class LastfmProcessor extends BaseFeedProcessor
{

    /**
     *
     * @inheritdoc
     */
    protected function extractDatas(\SimpleXMLElement $xml)
    {
        $datas = array();
        foreach ($xml->artist as $value) {
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
            $datasFormatted[] = array(
                'text'      => (string) $data->name,
                'url'       => (string) $data->url,
                'playcount' => (string) $data->playcount,
            );
        }

        return $datasFormatted;
    }

}
