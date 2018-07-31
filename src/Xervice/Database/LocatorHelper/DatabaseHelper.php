<?php


namespace Xervice\Database\LocatorHelper;


use Xervice\Core\HelperClass\HelperInterface;
use Xervice\Core\Locator\Proxy\ProxyInterface;

class DatabaseHelper implements HelperInterface
{
    /**
     * @var array
     */
    private $databaseContainer;

    /**
     * @return string
     */
    public function getMethodName(): string
    {
        return 'queryContainer';
    }

    /**
     * @param \Xervice\Core\Locator\Proxy\ProxyInterface $proxy
     *
     * @return mixed|void
     */
    public function getHelper(ProxyInterface $proxy)
    {
        $serviceName = $proxy->getServiceName();

        if (!isset($this->databaseContainer[$serviceName])) {
            foreach ($proxy->getServiceNamespaces('QueryContainer') as $class) {
                if (class_exists($class)) {
                    $this->databaseContainer[$serviceName] = new $class();
                    break;
                }
            }

            if ($this->databaseContainer[$serviceName] === null) {
                $this->databaseContainer[$serviceName] = new EmptyQueryContainer();
            }
        }

        return $this->databaseContainer[$serviceName];
    }
}