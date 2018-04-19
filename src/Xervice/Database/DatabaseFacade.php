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
     * Initialize Propel database connection
     *
     * @api
     *
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function initDatabase()
    {
        $this->getFactory()->createPropelProvider()->init();
    }

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
     * Build all models
     *
     * @api
     *
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function buildModel()
    {
        return $this->getFactory()->createPropelCommandProvider()->execute('model:build');
    }

    /**
     * Runs all migrations
     *
     * @api
     *
     * @return array
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function migrate()
    {
        $result = $this->getFactory()->createPropelCommandProvider()->execute('migration:diff');
        return array_merge(
            $result,
            $this->getFactory()->createPropelCommandProvider()->execute('migration:migrate')
        );
    }
}