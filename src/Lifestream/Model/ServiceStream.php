<?php

namespace Lifestream\Model;

/**
 * Manage the service stream. Able to manage statuses
 *
 * @package Lifestream
 * @subpackage Stream
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
class ServiceStream
{

    /**
     * @var array The stream
     */
    protected $stream = array();
    /**
     * @var String StatusClassname
     */
    protected $statusClassname;

    /**
     *
     * @param Status $statusClassname
     */
    public function __construct($statusClassname = 'Lifestream\\Model\\Status')
    {
        $this->statusClassname = $statusClassname;
    }

    /**
     * Add a Status to the ServiceStream
     *
     * $datas must contain at least 'text'. Could also contains 'url', 'date'.
     * Anything else will be placed in options
     *
     * @param array $datas Datas must contain at least 'text'.
     * @return void
     */
    public function addStatus(array $datas)
    {
        $status = $this->getNewStatus();

        if (isset($datas['text'])) {
            $status->text = $datas['text'];
            unset($datas['text']);
        } else {
            throw new \Exception('Text is not definied');
        }
        if (isset($datas['url'])) {
            $status->url = $datas['url'];
            unset($datas['url']);
        }
        if (isset($datas['date'])) {
            $status->date = $datas['date'];
            unset($datas['date']);
        }
        if (0 < count($datas)) {
            $status->options = $datas;
        }

        $this->stream[] = $status;
    }

    /**
     * Set a new stream
     *
     * @param array $stream
     * @return void
     */
    public function setStream(array $stream = array())
    {
        $this->stream = $stream;
    }

    /**
     * Clone a new status.
     *
     * @return Status A new status
     */
    protected function getNewStatus()
    {
        return new $this->statusClassname;
    }

    /**
     * Get the stream
     *
     * @param int $maxItem -1 for illimited items
     * @return array The stream
     */
    public function getStream($maxItem = 10)
    {
        if (-1 == $maxItem) {
            return $this->stream;
        }

        return array_slice($this->stream, 0, $maxItem);
    }

    public function setStatusClassname($statusClassname)     {
        $this->statusClassname = $statusClassname;
    }


}
