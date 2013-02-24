<?php

namespace Lyrixx\Lifestream\Service;

use Lyrixx\Lifestream\StatusInterface;

/**
 * ServiceInterface will be in charges to fetch datas,
 * and convert each status to a StatusInterface object.
 */
interface ServiceInterface
{
    /**
     * Returns a collection of StatusInterface
     *
     * @return array A colection StatusInterface
     */
    public function getStatuses();

    /**
     * Returns the service name
     *
     * @return string The service name
     */
    public function getName();

    /**
     * Sets the status classname.
     * Must implement StatusInterface.
     *
     * I will be used to create a new StatusInterface with fetched datas
     *
     * @param string $statusClassname The status classname
     */
    public function setStatusClassname($statusClassname);

}
