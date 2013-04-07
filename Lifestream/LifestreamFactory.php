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
        'twitter'        => 'Lyrixx\Lifestream\Service\Twitter',
        'twitter_search' => 'Lyrixx\Lifestream\Service\TwitterSearch',
        'twitter_list'   => 'Lyrixx\Lifestream\Service\TwitterList',
        'github'         => 'Lyrixx\Lifestream\Service\Github',
        'rss20'          => 'Lyrixx\Lifestream\Service\Rss20',
        'atom'           => 'Lyrixx\Lifestream\Service\Atom',
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

    public static function createNewInstance(Client $client = null)
    {
        return new static($client);
    }

    /**
     * Create a Lifestream with a nammed service
     *
     * @param string               $service    A service among LifestreamFactory::getSupportedServices
     * @param string[]             $arguments  Arguments to give to service constructor
     * @param FormatterInterface[] $filters    A collection of FormatterInterface
     * @param FormatterInterface[] $formatters A collection of FormatterInterface
     *
     * @return Lifestream A lifestream
     */
    public function createLifestream($service, array $arguments = array(), array $filters = array(), array $formatters = array())
    {
        if (!array_key_exists($service, $this->services)) {
            throw new \InvalidArgumentException(sprintf(
                'Service "%s" not Found. Services supported: "%s"',
                 $service,
                 implode('", "', $this->getSupportedServices())
            ));
        }

        $reflect = new \ReflectionClass($this->services[$service]);
        $service = $reflect->newInstanceArgs($arguments);
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
