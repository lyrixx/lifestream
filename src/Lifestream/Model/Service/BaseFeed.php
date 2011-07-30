<?php

namespace Lifestream\Model\Service;

/**
 *
 * @package Lifestream
 * @subpackage Service
 * @author lyrix
 */
abstract class BaseFeed extends BaseService
{

    /**
     * The feed processor should fetch, format and return datas from an URL
     * @var Object Object with rssProcessor capabilities
     */
    protected $feedProcessor;

    /**
     * The the feed url
     *
     * @param int $maxItem return a least $maxItem item
     * @return string An url
     */
    protected function getFeedUrl()
    {
        return $this->feedUrl;
    }

    /**
     *
     * @inheritdoc
     */
    protected function requestRawDatas()
    {
        if (!$this->feedProcessor) {
            throw new \RuntimeException(sprintf('Feed Processor is not defined (current class : "%s")', get_class($this)));
        }

        $this->feedProcessor->setFeedUrl($this->getFeedUrl());
        $this->rawDatas = $this->feedProcessor->process()->getDatas();
    }

    /**
     *
     * @inheritdoc
     */
    public function getServiceURL()
    {
        return $this->feedUrl;
    }

    /**
     *
     * @param type $feedProcessor Object with rssProcessor capabilities
     * @return void
     */
    public function setFeedProcessor($feedProcessor)
    {
        $this->feedProcessor = $feedProcessor;
    }

    /**
     *
     * @inheritdoc
     */
    protected function processRawDatas()
    {
        $this->preProcessRawDatas();
        foreach ($this->rawDatas as $data) {
            $this->serviceStream->addStatus($data);
        }
    }

}
