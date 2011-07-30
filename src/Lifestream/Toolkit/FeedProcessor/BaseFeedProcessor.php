<?php

namespace Lifestream\Toolkit\FeedProcessor;

/**
 * Fetch datas from an url, manage theme an return them
 *
 * @package Lifestream
 * @subpackage Feed
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
abstract class BaseFeedProcessor implements FeedProcessorInterface
{

    /**
     *
     * @var string The feed url
     */
    protected $feedUrl = null;
    /**
     *
     * @var Oject httpClient adapter
     */
    protected $httpClient;
    /**
     *
     * @var array Datas
     */
    protected $datas;

    /**
     *
     * @param Object $curl Curl
     * @param string $feedUrl FeedURl
     * @return FeedProcessorInterface $this
     */
    function __construct($httpClient, $feedUrl = null)
    {
        $this->httpClient = $httpClient;
        $this->feedUrl = $feedUrl;

        return $this;
    }

    /**
     * Extract Important datas from the xml feed
     *
     * @param SimpleXMLElement $xml Xml Root
     * @return array Important datas
     */
    abstract protected function extractDatas(\SimpleXMLElement $xml);

    /**
     * Adapt Raw Data
     *
     * @param array $datas
     * @return array datas
     */
    abstract protected function formatDatas(array $datas);

    /**
     *
     * @inheritdoc
     */
    public function process()
    {
        $datas = $this->requestDatas();
        $datas = $this->formatDatas($datas);
        $this->datas = $datas;

        return $this;
    }

    /**
     * Fetch data from url
     *
     */
    protected function requestDatas()
    {
        if (!$this->httpClient) {
            throw new \Exception('HttpClient is not defined');
        }

        if (!$this->feedUrl) {
            throw new \Exception('feedUrl is not defined');
        }

        $response = $this->httpClient->get($this->feedUrl);

        if (!$content = $response->getContent()) {
            throw new \Exception(sprintf('Data fetching failed (feedUrl : "%s")', $this->feedUrl));
        }

        if (!in_array(substr($response->getStatusCode(), 0, 1), array('2', '3'))) {
            throw new \Exception(sprintf('Browser faild with "%s" ; Status : "%s"', $this->feedUrl, $response->getStatusCode()));
        }

        $xml = new \SimpleXMLElement($content);

        $datas = $this->extractDatas($xml);

        return $datas;
    }

    /**
     *
     * @inheritdoc
     */
    public function setHttpClient($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     *
     * @inheritdoc
     */
    public function setFeedUrl($feedUrl)
    {
        $this->feedUrl = $feedUrl;
    }

    /**
     *
     * @inheritdoc
     */
    public function getDatas()
    {
        return $this->datas;
    }

}
