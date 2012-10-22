<?php

namespace Lifestream;

use Lifestream\Service\ServiceInterface;
use Lifestream\Formatter\FormatterInterface;
use Lifestream\Filter\FilterInterface;

class Lifestream
{

    private $service;
    private $filters    = array();
    private $formatters = array();
    private $stream;
    private $isBooted;

    public function __construct(ServiceInterface $service, array $filters = array(), array $formatters = array(), StreamInterface $stream = null)
    {
        $this->service = $service;
        $this->setFilters($filters);
        $this->setFormatters($formatters);
        $this->stream = $stream ?: new Stream();
        $this->isBooted = false;
    }

    public function boot()
    {
        foreach ($this->service->getStatuses() as $status) {
            foreach ($this->filters as $filter) {
                if (!$filter->isValid($status)) {
                    break;
                    continue;
                }
            }

            foreach ($this->formatters as $formatter) {
                $status = $formatter->format($status);
            }

            $this->stream->addStatus($status);
        }

        $this->isBooted = true;

        return $this;
    }

    public function getService()
    {
        return $this->service;
    }

    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    public function addFilter(FilterInterface $filter)
    {
        $this->filters[] = $filter;

        return $this;
    }

    public function setFilters(array $filters)
    {
        foreach ($filters as $filter) {
            $this->addFilter($filter);
        }

        return $this;
    }

    public function addFormatter(FormatterInterface $formatter)
    {
        $this->formatters[] = $formatter;

        return $this;
    }

    public function setFormatters(array $formatters)
    {
        foreach ($formatters as $formatter) {
            $this->addFormatter($formatter);
        }

        return $this;
    }

    public function getStream($limit = 10)
    {
        if (!$this->isBooted) {
            throw new \RuntimeException('You must boot Lifestream before try to get stream');
        }

        return $this->stream->getStream($limit);
    }
}
