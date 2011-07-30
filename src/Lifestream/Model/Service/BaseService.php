<?php

namespace Lifestream\Model\Service;

use Lifestream\Model\ServiceStream;
use Lifestream\Model\Filter\FilterInterface;
use Lifestream\Model\Formatter\FormatterInterface;

/**
 * BaseService implements common functions
 *
 * @package Lifestream
 * @subpackage Service
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
abstract class BaseService implements ServiceInterface
{

    /**
     * @var String FeedUrl
     */
    protected $feedUrl;
    /**
     * @var ServiceStream ServiceStream
     */
    protected $serviceStream;
    /**
     * @var array|object Raw Datas must be iterable
     */
    protected $rawDatas;
    /**
     * @var array Contains a list of class that implements FilterInterface
     */
    protected $filters = array();
    /**
     * @var array Contains a list of class that implements FormatterInterface
     */
    protected $formatters = array();

    /**
     *
     * @inheritdoc
     */
    public function __construct($serviceStreamClassname = 'Lifestream\\Model\\ServiceStream', array $filters = array(), array $formatters = array())
    {
        $this->serviceStream    = new $serviceStreamClassname;
        $this->filters          = $filters;
        $this->formatters       = $formatters;
    }

    /**
     *
     * @inheritdoc
     */
    public function setFeedURl($feedUrl)
    {
        $this->feedUrl = $feedUrl;
    }

    /**
     * Fetch datas from webservice
     *
     * @param Int $maxItem : Fetch at most $maxItem items
     * @return void
     */
    abstract protected function requestRawDatas();

    /**
     * Convert rawDatas to serviceStream
     *
     * @abstract
     * @return void
     */
    abstract protected function processRawDatas();

    /**
     *
     * @inheritdoc
     */
    public function processFeed()
    {
        $this->requestRawDatas();
        $this->processRawDatas();
        $this->processFilters();
        $this->processFormatters();

        return $this;
    }

    /**
     *
     * @inheritdoc
     */
    public function getStream($maxItem = 20)
    {
        return $this->serviceStream->getStream($maxItem);
    }

    /**
     * Ensure that rawdatas are iterable
     *
     * @throws InvalidArgumentException If rawDatas are not iterable
     * @return void
     */
    protected function preProcessRawDatas()
    {
        if (!is_array($this->rawDatas) && !$this->rawDatas instanceof \Iterator) {
            throw new InvalidArgumentException("rawDatas are not iterable");
        }
        $this->serviceStream->setStream(array());
    }

    /**
     * Process all filters
     *
     * @return void
     */
    protected function processFilters()
    {
        foreach ($this->getFilters() as $filter) {
            $filter->setStream($this->serviceStream->getStream(-1));
            $streamFiltered = $filter->process();
            $this->serviceStream->setStream($streamFiltered);
        }
    }

    /**
     * Process all formatter
     *
     * @return void
     */
    protected function processFormatters()
    {
        foreach ($this->getFormatters() as $formatters) {
            $formatters->setStream($this->serviceStream->getStream(-1));
            $streamFormatter = $formatters->process();
            $this->serviceStream->setStream($streamFormatter);
        }
    }

    /**
     *
     * @inheritdoc
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     *
     * @inheritdoc
     */
    public function setFilters(array $filters)
    {
        if (!is_array($filters)) {
            $filters = array($filters);
        }
        foreach ($filters as $filter) {
            if (!$filter instanceof FilterInterface) {
                throw new \InvalidArgumentException(sprintf('"%s" is not a filter (current class : %s)', get_class($filter), get_class($this)));
            }
        }

        $this->filters = $filters;
    }

    /**
     *
     * @inheritdoc
     */
    public function getFormatters()
    {
        return $this->formatters;
    }

    /**
     *
     * @inheritdoc
     */
    public function setFormatters(array $formatters)
    {
        if (!is_array($formatters)) {
            $formatters = array($formatters);
        }
        foreach ($formatters as $formatter) {
            if (!$formatter instanceof FormatterInterface) {
                throw new \InvalidArgumentException(sprintf('"%s" is not a formatter (current class : %s)', get_class($filter), get_class($this)));
            }
        }

        $this->formatters = $formatters;
    }

}
