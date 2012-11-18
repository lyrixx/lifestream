<?php

namespace Lyrixx\Lifestream;

/**
 * LifestreamFactory. Use to create lifestream for Feed Service
 */
class LifestreamFactory
{
    private $browser;

    private $services = array(
        'twitter' => 'Lyrixx\Lifestream\Service\Twitter',
        'github'  => 'Lyrixx\Lifestream\Service\Github',
        'rss20'   => 'Lyrixx\Lifestream\Service\Rss20',
        'atom'    => 'Lyrixx\Lifestream\Service\Atom',
    );

    public function __construct($browser)
    {
        $this->browser = $browser;
    }

    public function createService($service, $username, array $filters = array(), array $formatters = array())
    {
        if (!array_key_exists($service, $this->services)) {
            throw new NotFoundHttpException(sprintf(
                'Service "%s" not Found. Services supported: "%s"',
                 $service,
                 implode('", "', $this->getSupportedServices())
            ));
        }

        $className = $this->services[$service];
        $service = new $className($this->browser, $username);

        $lifestream = new Lifestream($service, $filters, $formatters);

        return $lifestream;
    }

    public function setService($serviceName, $serviceClass)
    {
        $this->services[$serviceName] = $serviceClass;
    }

    public function getSupportedServices()
    {
        return array_keys($this->services);
    }
}
