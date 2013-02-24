<?php

namespace Lyrixx\Lifestream\Service;

/**
 * AbstractService implements common methods of ServiceInterface
 */
abstract class AbstractService implements ServiceInterface
{
    protected $stream          = array();
    protected $statusClassname = 'Lyrixx\Lifestream\Status';

    /**
     * Return an array of raw status
     *
     * @return array A collection of raw status
     */
    abstract protected function getDatas();

    /**
     * {@inheritdoc}
     */
    public function getStatuses()
    {
        foreach ($this->getDatas() as $data) {
            $this->stream[] = $this->createNewStatusInstance($data);
        }

        return $this->stream;
    }

    /**
     * {@inheritdoc}
     */
    public function setStatusClassname($statusClassname)
    {
        $this->statusClassname = $statusClassname;
    }

    /**
     * Get a new instance of a status, according to $this->$statusClassname
     *
     * @param array $datas Some datas, to inject into new StatusInterface
     *
     * @return StatusInterface A new status
     */
    protected function createNewStatusInstance($datas = array())
    {
        $class = $this->statusClassname;

        return new $class($datas);
    }
}
