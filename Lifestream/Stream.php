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
    protected $stream;

    public function __construct()
    {
        $this->stream = new \SplDoublyLinkedList();
    }

    /**
     * {@inheritdoc}
     */
    public function addStatus(StatusInterface $status)
    {
        $this->stream->push($status);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return $this->stream;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->stream);
    }

}
