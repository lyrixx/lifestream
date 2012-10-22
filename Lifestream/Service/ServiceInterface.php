<?php

namespace Lifestream\Service;

use Lifestream\StatusInterface;

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
     * Return a collection of StatusInterface
     *
     * @return array A colection StatusInterface
     */
    public function getStatuses();

    /**
     * Return the service name
     *
     * @return string the service name
     */
    public function getName();

    /**
     * set the status classname.
     * Must implement StatusInterface
     *
     * @param string $statusClassname The status classname
     */
    public function setStatusClassname($statusClassname);

}
