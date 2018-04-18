<?php


namespace Xervice\Database\Provider;


use Propel\Runtime\Connection\ConnectionManagerInterface;
use Propel\Runtime\ServiceContainer\ServiceContainerInterface;

class PropelProvider implements PropelProviderInterface
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var \Propel\Runtime\ServiceContainer\ServiceContainerInterface
     */
    private $serviceContainer;

    /**
     * @var \Propel\Runtime\Connection\ConnectionManagerInterface
     */
    private $manager;

    /**
     * PropelProvider constructor.
     *
     * @param array $config
     * @param \Propel\Runtime\ServiceContainer\ServiceContainerInterface $serviceContainer
     * @param \Propel\Runtime\Connection\ConnectionManagerInterface $this ->manager
     */
    public function __construct(
        array $config,
        ServiceContainerInterface $serviceContainer,
        ConnectionManagerInterface $manager
    ) {
        $this->config = $config;
        $this->serviceContainer = $serviceContainer;
        $this->manager = $manager;
    }

    public function init()
    {
        $this->createManager();
        $this->configure();
    }

    private function createManager(): void
    {
        $this->manager->setConfiguration($this->getManagerConfig());
        $this->manager->setName('default');
    }

    /**
     * @return mixed
     */
    private function getManagerConfig()
    {
        $config = $this->config['propel']['database']['connections']['default'];
        $config['model_paths'] = [
            0 => 'src',
            1 => 'vendor'
        ];
        return $config;
    }

    private function configure(): void
    {
        $this->serviceContainer->checkVersion('2.0.0');
        $this->serviceContainer->checkVersion('2.0.0-dev');
        $this->serviceContainer->setAdapterClass('default', 'pgsql');
        $this->serviceContainer->setConnectionManager('default', $this->manager);
        $this->serviceContainer->setDefaultDatasource('default');
    }
}