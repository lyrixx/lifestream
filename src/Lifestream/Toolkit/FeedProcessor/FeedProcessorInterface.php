<?php

namespace Lifestream\Toolkit\FeedProcessor;

/**
 * Fetch datas from an url, manage theme an return them
 *
 * @package Lifestream
 * @subpackage Feed
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
interface FeedProcessorInterface
{

    /**
     * Run fetching and format data
     *
     * @return FeedProcessorInterface $this
     */
    public function process();

    /**
     * Set httpClient
     *
     * @param Object httpClient
     * @return void
     */
    public function setHttpClient($httpClient);

    /**
     * Set FeedUrl
     *
     * @param string The feed
     * @return void
     */
    public function setFeedUrl($feedUrl);

    /**
     * Retrieve datas
     *
     * @return array The datas
     */
    public function getDatas();

}
