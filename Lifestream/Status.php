<?php

namespace Lyrixx\Lifestream;

/**
 * Status implementation. Implements StatusInterface
 */
class Status implements StatusInterface
{
    /**
     * @var string Text
     */
    private $text;

    /**
     * @var string Url
     */
    private $url;

    /**
     * @var string Date
     */
    private $date;

    /**
     * @var array Extra
     */
    private $extra;

    /**
     * Construtor
     *
     * @param array $datas An array of data.
     *                     Set test, url and date to class attributes.
     *                     Other datas are stored in extra attributes
     */
    public function __construct(array $datas = array())
    {
        if (isset($datas['text'])) {
            $this->setText($datas['text']);
            unset($datas['text']);
        }
        if (isset($datas['url'])) {
            $this->setUrl($datas['url']);
            unset($datas['url']);
        }
        if (isset($datas['date'])) {
            $this->setDate($datas['date']);
            unset($datas['date']);
        }

        $this->setExtra($datas);
    }

    /**
     * {@inheritdoc}
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * {@inheritdoc}
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * {@inheritdoc}
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * {@inheritdoc}
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * {@inheritdoc}
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->text;
    }

}
