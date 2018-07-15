<?php
declare(strict_types=1);


namespace Xervice\Database;


use Propel\Runtime\Connection\ConnectionManagerInterface;
use Propel\Runtime\Connection\ConnectionManagerSingle;
use Propel\Runtime\Propel;
use Propel\Runtime\ServiceContainer\ServiceContainerInterface;
use Xervice\Database\Config\Converter\ConverterInterface;
use Xervice\Database\Config\Converter\Json;
use Xervice\Database\Config\Generator;
use Xervice\Database\Config\GeneratorInterface;
use Xervice\Core\Factory\AbstractFactory;
use Xervice\Database\Provider\PropelCommandProvider;
use Xervice\Database\Provider\PropelCommandProviderInterface;
use Xervice\Database\Provider\PropelProvider;
use Xervice\Database\Provider\PropelProviderInterface;

/**
 * @method \Xervice\Database\DatabaseConfig getConfig()
 */
class DatabaseFactory extends AbstractFactory
{
    /**
     * @return \Xervice\Database\Provider\PropelProvider
     */
    public function createPropelProvider(): PropelProviderInterface
    {
        return new PropelProvider(
            $this->getConfig()->getPropelConfig(),
            $this->getPropelServiceContainer(),
            $this->createPropelConnectionManager()
        );
    }

    /**
     * @return \Propel\Runtime\Connection\ConnectionManagerSingle
     */
    public function createPropelConnectionManager(): ConnectionManagerInterface
    {
        return new ConnectionManagerSingle();
    }

    /**
     * @return \Xervice\Database\Config\GeneratorInterface
     */
    public function createConfigGenerator(): GeneratorInterface
    {
        return new Generator(
            $this->getConfig()->getPropelConfig(),
            $this->getConfig()->getConfDir(),
            $this->createConfigConverter()
        );
    }

    /**
     * @return \Xervice\Database\Provider\PropelCommandProvider
     */
    public function createPropelCommandProvider(): PropelCommandProviderInterface
    {
        return new PropelCommandProvider(
            $this->getConfig()->getPropelCommand(),
            $this->getConfig()->get('APPLICATION_PATH'),
            $this->getConfig()->getConfDir()
        );
    }

    /**
     * @return \Xervice\Database\Config\Converter\ConverterInterface
     */
    public function createConfigConverter(): ConverterInterface
    {
        return new Json();
    }

    /**
     * @return \Propel\Runtime\ServiceContainer\ServiceContainerInterface
     */
    public function getPropelServiceContainer(): ServiceContainerInterface
    {
        return Propel::getServiceContainer();
    }
}
