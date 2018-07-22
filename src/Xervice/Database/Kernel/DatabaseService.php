<?php


namespace Xervice\Database\Kernel;


use Xervice\Core\Locator\AbstractWithLocator;
use Xervice\Kernel\Business\Service\ServiceInterface;
use Xervice\Kernel\Business\Service\ServiceProviderInterface;

/**
 * @method \Xervice\Database\DatabaseFacade getFacade()
 */
class DatabaseService extends AbstractWithLocator implements ServiceInterface
{
    /**
     * @param \Xervice\Kernel\Business\Service\ServiceProviderInterface $serviceProvider
     *
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function boot(ServiceProviderInterface $serviceProvider): void
    {
        $this->getFacade()->initDatabase();
    }

    /**
     * @param \Xervice\Kernel\Business\Service\ServiceProviderInterface $serviceProvider
     */
    public function execute(ServiceProviderInterface $serviceProvider): void
    {
    }
}
