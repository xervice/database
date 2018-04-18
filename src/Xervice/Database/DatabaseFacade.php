<?php


namespace Xervice\Database;


use Symfony\Component\Process\Process;
use Xervice\Core\Facade\AbstractFacade;

/**
 * @method \Xervice\Database\DatabaseFactory getFactory()
 * @method \Xervice\Database\DatabaseConfig getConfig()
 */
class DatabaseFacade extends AbstractFacade
{
    /**
     * Generate propel config from project config
     *
     * @api
     *
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function generateConfig()
    {
        $this->getFactory()->createConfigGenerator()->generate();
    }

    /**
     * Generate propel config in propel directory
     *
     * @api
     *
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function convertConfig()
    {
        $this->getFactory()->createPropelCommandProvider()->execute('config:convert');
    }

    /**
     * Build all models
     *
     * @api
     *
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function buildModel()
    {
        $this->getFactory()->createPropelCommandProvider()->execute('model:build');
    }

    /**
     * Runs all migrations
     *
     * @api
     *
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function migrate()
    {
        $this->getFactory()->createPropelCommandProvider()->execute('migration:diff');
        $this->getFactory()->createPropelCommandProvider()->execute('migration:migrate');
    }
}