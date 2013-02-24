<?php

namespace Lyrixx\Lifestream;

use Lyrixx\Lifestream\Formatter\FormatterInterface;
use Lyrixx\Lifestream\Service\ServiceFeedInterface;
use Guzzle\Http\Client;

/**
 * LifestreamFactory. Use to create lifestream for ServiceFeedInterface
 */
class LifestreamFactory
{
    private $client;

    private $services = array(
        'twitter' => 'Lyrixx\Lifestream\Service\Twitter',
        'github'  => 'Lyrixx\Lifestream\Service\Github',
        'rss20'   => 'Lyrixx\Lifestream\Service\Rss20',
        'atom'    => 'Lyrixx\Lifestream\Service\Atom',
    );

    /**
     * Conctructor
     *
     * @param mixed $client The client
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client ?: new Client();
    }

    /**
     * Create a Lifestream with a nammed service
     *
     * @param sting                $service    A service among LifestreamFactory::getSupportedServices
     * @param string               $username   A username
     * @param FormatterInterface[] $filters    A collection of FormatterInterface
     * @param FormatterInterface[] $formatters A collection of FormatterInterface
     *
     * @return Lifestream A lifestream
     */
    public function createLifestream($service, $username, array $filters = array(), array $formatters = array())
    {
        if (!array_key_exists($service, $this->services)) {
            throw new NotFoundHttpException(sprintf(
                'Service "%s" not Found. Services supported: "%s"',
                 $service,
                 implode('", "', $this->getSupportedServices())
            ));
        }

        $className = $this->services[$service];
        $service = new $className($username);
        $service->setClient($this->client);

        $lifestream = new Lifestream($service, $filters, $formatters);

        return $lifestream;
    }

    /**
     * Add or replace a service
     *
     * @param string $serviceName  A service identifier
     * @param string $serviceClass A service class. Should implements ServiceFeedInterface
     */
    public function setService($serviceName, $serviceClass)
    {
        $this->services[$serviceName] = $serviceClass;
    }

    /**
     * Get supported services
     *
     * @return string[] Supported services
     */
    public function getSupportedServices()
    {
        return array_keys($this->services);
    }
}
