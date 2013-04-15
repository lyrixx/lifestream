<?php

namespace Lyrixx\Lifestream;

/**
 * Stream implementation. Implements StreamInterface.
 * It use internally an array to store StatusInterface
 */
class Stream implements StreamInterface
{
    /**
     * @var array The stream
     */
    private $stream = array();

    /**
     * {@inheritdoc}
     */
    public function addStatus(StatusInterface $status)
    {
        $this->stream[] = $status;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->stream);
    }


    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        reset($this->stream);
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        $var = current($this->stream);

        return $var;
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        $var = key($this->stream);

        return $var;
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        $var = next($this->stream);

        return $var;
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        $key = key($this->stream);
        $var = ($key !== NULL && $key !== FALSE);

        return $var;
    }
}
