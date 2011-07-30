<?php

namespace Lifestream\Model\Service;

use Lifestream\Model\ServiceStream;

/**
 * Interface for a service (Twitter, Delicious, Rss, etc)
 *
 * @package Lifestream
 * @subpackage Service
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
interface ServiceInterface
{

    /**
     *
     * @param String $serviceStreamClassname
     * @param Array $filters array of filters,  Filter must impletments FilterInterface
     * @param Array $formatters array of formatters,  formatter must impletments FormattersInterface
     * @return void
     */
    public function __construct($serviceStreamClassname, array $filters = array(), array $formatters = array());

    /**
     * @param String $feedUrl The url to fetch
     * @return void
     */
    public function setFeedURl($feedUrl);

    /**
     * Process the stream : Fetch and process datas, then apply filter and formatters
     *
     * @return void
     */
    public function processFeed();

    /**
     * Get the stream
     *
     * @param Int $maxItem  : return at most $maxItem item
     * @return Array The stream
     */
    public function getStream($maxItem = 20);

    /**
     * Get an array of filters
     *
     * @return array The filters
     */
    public function getFilters();

    /**
     * Set an array of filters, Filter must impletments FilterInterface
     *
     * @param Array $filters Filter must impletments FilterInterface
     * @return ServiceInterface $this
     */
    public function setFilters(array $filters);

    /**
     * Get an array of formatters
     *
     * @return array The formatters
     */
    public function getFormatters();

    /**
     * Set an array of formatter, Formatter must impletments FormatterInterface
     *
     * @param Array $formatter Formatter must impletments FormatterInterface
     * @return ServiceInterface $this
     */
    public function setFormatters(array $formatter);

    /**
     * Get service url
     *
     * @return String The service url
     */
    public function getServiceURL();

}
