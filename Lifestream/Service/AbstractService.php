<?php

namespace Lifestream\Service;

/**
 * BaseService implements common functions
 *
 * @package Lifestream
 * @subpackage Service
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
abstract class AbstractService implements ServiceInterface
{
    protected $stream          = array();
    protected $statusClassname = '\Lifestream\Status';

    public function getStatuses()
    {
        foreach ($this->getDatas() as $data) {
            $this->stream[] = $this->getNewStatus($data);
        }

        return $this->stream;
    }

    abstract protected function getDatas();

    /**
     * {@inheritdoc}
     */
    public function setStatusClassname($statusClassname)
    {
        $this->statusClassname = $statusClassname;
    }

    /**
     * Get a new instance of a status.
     *
     * @return Status A new status
     */
    protected function getNewStatus($datas = array())
    {
        $class = $this->statusClassname;

        return new $class($datas);
    }
}
