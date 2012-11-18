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
     * @var array Options
     */
    private $options;

    /**
     * Construtor
     *
     * @param array $datas An array of option.
     *                     Set test, url and date to class attributes.
     *                     Other datas are stored in options attributes
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
        $this->setOptions($datas);

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
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * {@inheritdoc}
     */
    public function setOptions($options)
    {
        $this->options = $options;

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
