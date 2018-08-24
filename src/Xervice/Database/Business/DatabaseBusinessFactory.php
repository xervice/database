<?php
declare(strict_types=1);


namespace Xervice\Database\Business;


use Propel\Runtime\Connection\ConnectionManagerInterface;
use Propel\Runtime\Connection\ConnectionManagerSingle;
use Propel\Runtime\Propel;
use Propel\Runtime\ServiceContainer\ServiceContainerInterface;
use Xervice\Core\Business\Model\Factory\AbstractBusinessFactory;
use Xervice\Database\Business\Model\Config\Converter\ConverterInterface;
use Xervice\Database\Business\Model\Config\Converter\Json;
use Xervice\Database\Business\Model\Config\Generator;
use Xervice\Database\Business\Model\Config\GeneratorInterface;
use Xervice\Database\Business\Model\Model\BuildModel;
use Xervice\Database\Business\Model\Model\BuildModelInterface;
use Xervice\Database\Business\Model\Provider\PropelCommandProvider;
use Xervice\Database\Business\Model\Provider\PropelCommandProviderInterface;
use Xervice\Database\Business\Model\Provider\PropelProvider;
use Xervice\Database\Business\Model\Provider\PropelProviderInterface;

/**
 * @method \Xervice\Database\DatabaseConfig getConfig()
 */
class DatabaseBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Xervice\Database\Business\Model\Model\BuildModelInterface
     */
    public function createBuildModel(): BuildModelInterface
    {
        return new BuildModel(
            $this->createPropelCommandProvider(),
            $this->getConfig()->getSchemaPaths(),
            $this->getConfig()->getSchemaTarget(),
            $this->getConfig()->getSchemaPattern()
        );
    }


    /**
     * @return \Xervice\Database\Business\Model\Provider\PropelProviderInterface
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
     * @return \Xervice\Database\Business\Model\Config\GeneratorInterface
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
     * @return \Xervice\Database\Business\Model\Provider\PropelCommandProviderInterface
     */
    public function createPropelCommandProvider(): PropelCommandProviderInterface
    {
        return new PropelCommandProvider(
            $this->getConfig()->getPropelCommand(),
            $this->getConfig()->getApplicationPath(),
            $this->getConfig()->getConfDir()
        );
    }

    /**
     * @return \Xervice\Database\Business\Model\Config\Converter\ConverterInterface
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
