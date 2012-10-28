<?php

namespace Lifestream\Service;

use Lifestream\StatusInterface;

/**
 * ServiceInterface will be in charges to fetch datas,
 * and convert each status to a StatusInterface object.
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
     * @return string The service name
     */
    public function getName();

    /**
     * set the status classname.
     * Must implement StatusInterface.
     *
     * I will be use to create a new StatusInterface with fetched datas
     *
     * @param string $statusClassname The status classname
     */
    public function setStatusClassname($statusClassname);

}
