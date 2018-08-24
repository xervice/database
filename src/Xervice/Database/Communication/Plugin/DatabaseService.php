<?php


namespace Xervice\Database\Communication\Plugin;


use Xervice\Core\Plugin\AbstractCommunicationPlugin;
use Xervice\Kernel\Business\Model\Service\ServiceProviderInterface;
use Xervice\Kernel\Business\Plugin\BootInterface;

/**
 * @method \Xervice\Database\Business\DatabaseFacade getFacade()
 */
class DatabaseService extends AbstractCommunicationPlugin implements BootInterface
{
    /**
     * @param \Xervice\Kernel\Business\Model\Service\ServiceProviderInterface $serviceProvider
     */
    public function boot(ServiceProviderInterface $serviceProvider): void
    {
        $this->getFacade()->initDatabase();
    }
}
