<?php

namespace Lyrixx\Lifestream\Service;

use Guzzle\Http\Client;
use Guzzle\Http\Message\Response;

/**
 * Aggregate
 *
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
class Aggregate implements ServiceInterface
{
    private $services;
    private $client;

    public function __construct(array $services = array(), Client $client = null)
    {
        $this->client = $client ?: new Client();
        $this->services = array();
        $this->setServices($services);
    }

    /**
     * Set services
     *
     * @param ServiceInterface[] $services
     *
     * @return ServiceInterface $this
     */
    public function setServices(array $services = array())
    {
        foreach ($services as $service) {
            $this->addService($service);
        }

        return $this;
    }

    /**
     * Add a serice
     *
     * @param ServiceInterface $service
     *
     * @return ServiceInterface $this
     */
    public function addService(ServiceInterface $service)
    {
        $this->services[] = $service;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatuses()
    {
        $requests = array();
        foreach ($this->services as $k => $service) {
            $requests[$k] = $this->client->createRequest('GET', $service->getFeedUrl());
        }

        $responses = $this->client->send($requests);

        $statuses = array();
        foreach ($this->services as $k => $service) {
            $service->setResponse($responses[$k]);
            foreach ($service->getStatuses() as $status) {
                $statuses[] = $status;
            }
        }

        usort($statuses, function($s1, $s2) {
            return $s1->getDate() > $s2->getDate();
        });

        return $statuses;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'agregate';
    }

    /**
     * {@inheritdoc}
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @throws BadMethodCallException If method is calle
     */
    public function setStatusClassname($statusClassname)
    {
        throw new \BadMethodCallException('You can not call setStatusClassname on an AgregateService');
    }

    /**
     * @throws BadMethodCallException If method is calle
     */
    public function getFeedUrl()
    {
        throw new \BadMethodCallException('You can not call setStatusClassname on an AgregateService');
    }

    /**
     * @throws BadMethodCallException If method is calle
     */
    public function getProfileUrl()
    {
        throw new \BadMethodCallException('You can not call setStatusClassname on an AgregateService');
    }

    /**
     * @throws BadMethodCallException If method is calle
     */
    public function setResponse(Response $response)
    {
        throw new \BadMethodCallException('You can not call setStatusClassname on an AgregateService');
    }

    /**
     * @throws BadMethodCallException If method is calle
     */
    public function prepareRequest()
    {
        throw new \BadMethodCallException('You can not call setStatusClassname on an AgregateService');
    }
}
