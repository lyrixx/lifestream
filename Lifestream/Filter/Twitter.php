<?php

namespace Lyrixx\Lifestream\Filter;

use Lyrixx\Lifestream\StatusInterface;

/**
 * TwitterFilter
 *
 * Can invalidate:
 * * All reply
 * * All retweet
 *
 */
class Twitter implements FilterInterface
{
    const FILTER_REPLY   = 1;
    const FILTER_RETWEET = 2;

    private $flags;
    private $flagsAvailable = array(
        'FilterReply'   => self::FILTER_REPLY,
        'FilterRetweet' => self::FILTER_RETWEET,
    );

    /**
     * Constructor
     *
     * @param integer $flags Flags (a combinaison of FILTER_REPLY, FILTER_RETWEET, ...)
     */
    public function __construct($flags = 3)
    {
        $this->flags = $flags;
    }

    /**
     * {@inheritdoc}
     */
    public function isValid(StatusInterface $status)
    {
        foreach ($this->flagsAvailable as $method => $const) {
            if ($this->flags & $const) {
                $method = lcfirst($method);
                if (false === $this->$method($status)) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Enable a filter. See class constant for available filter
     *
     * @param int|string $flag The flag
     */
    public function enableFilter($flag)
    {
        if (is_string($flag)) {
            $flag = $this->convertStringFlag($flag);
        }

        $this->flags |= $flag;
    }

    /**
     * Disable a filter. See class constant for available filter
     *
     * @param int|string $flag The flag
     */
    public function disableFilter($flag)
    {
        if (is_string($flag)) {
            $flag = $this->convertStringFlag($flag);
        }

        $this->flags &= ~$flag;
    }

    /**
     * Return if a filter should be called
     *
     * @param int|string $flag The flag
     *
     * @return boolean If the filter sould be called
     */
    public function shouldFilter($flag)
    {
        if (is_string($flag)) {
            $flag = $this->convertStringFlag($flag);
        }

        return (boolean) ($this->flags & $flag);
    }

    /**
     * Magic PHP method to handle method like:
     *
     * * Twitter::enableFilterReply
     * * Twitter::disableFilterReply
     * * Twitter::shouldFilterReply
     */
    public function __call($method, $args)
    {
        if (0 === strpos($method, 'enable')) {
            $this->enableFilter(substr($method, 6));
        } elseif (0 === strpos($method, 'disable')) {
            $this->disableFilter(substr($method, 8));
        } elseif (0 === strpos($method, 'should')) {
            return $this->shouldFilter(substr($method, 6));
        }
    }

    private function convertStringFlag($flag)
    {
        if (!array_key_exists($flag, $this->flagsAvailable)) {
            throw new \InvalidArgumentException(sprintf('the flag "%s" does not exist in class "%s"', $flag, get_class($this)));
        }

        return $this->flagsAvailable[$flag];
    }

    /**
     * Invalidate all mentions (eg : tweet with start with a '@')
     *
     * @param  StatusInterface $status The status
     * @return boolean
     */
    private function filterReply(StatusInterface $status)
    {
        return 0 !== strpos($status->getText(), '@');
    }

    /**
     * Invalidate all Retweet (eg : tweet with start with a 'RT @')
     *
     * @param  StatusInterface $status The status
     * @return boolean
     */
    private function filterRetweet(StatusInterface $status)
    {
        return 0 !== strpos($status->getText(), 'RT @');
    }

}
