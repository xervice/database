<?php


namespace Xervice\Database;


use Xervice\Database\Config\Converter\ConverterInterface;
use Xervice\Database\Config\Converter\Json;
use Xervice\Database\Config\Generator;
use Xervice\Database\Config\GeneratorInterface;
use Xervice\Core\Factory\AbstractFactory;
use Xervice\Database\Provider\PropelCommandProvider;
use Xervice\Database\Provider\PropelCommandProviderInterface;

/**
 * @method \Xervice\Database\DatabaseConfig getConfig()
 */
class DatabaseFactory extends AbstractFactory
{
    /**
     * @return \Xervice\Database\Config\GeneratorInterface
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function createConfigGenerator() : GeneratorInterface
    {
        return new Generator(
            $this->getConfig()->getPropelConfig(),
            $this->getConfig()->getConfDir(),
            $this->createConfigConverter()
        );
    }

    /**
     * @return \Xervice\Database\Provider\PropelCommandProvider
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function createPropelCommandProvider() : PropelCommandProviderInterface
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
    public function createConfigConverter() : ConverterInterface
    {
        return new Json();
    }
}