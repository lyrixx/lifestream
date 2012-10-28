<?php

namespace Lifestream;

/**
 * Stream implementation. Implements StreamInterface.
 * It use internally an array to store StatusInterface
 */
class Stream implements StreamInterface
{
    /**
     * @var array The stream
     */
    protected $stream = array();

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
    public function setStream(array $stream = array())
    {
        foreach ($stream as $status) {
            $this->addStatus($status);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStream($limit = 10)
    {
        if (null === $limit) {
            return $this->stream;
        }

        return array_slice($this->stream, 0, $limit);
    }

}
