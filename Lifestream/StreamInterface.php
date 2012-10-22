<?php

namespace Lifestream;

/**
 * Manage the service stream. Able to manage statuses
 *
 * @package Lifestream
 * @subpackage Stream
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
interface StreamInterface
{

    /**
     * Add a StatusInterface to the stream
     *
     * @param StatusInterface $status The StatusInterface
     */
    public function addStatus(StatusInterface $status);

    /**
     * Set a new stream
     *
     * @param array $stream A collection a StatusInterface
     */
    public function setStream(array $stream = array());

    /**
     * Get the stream
     *
     * @param int|null $limit The number of StatusInterface. null for illimited Status.
     *
     * @return array The stream, a collecion of StatusInterface
     */
    public function getStream($limit = 10);

}
