<?php
declare(strict_types=1);


namespace Xervice\Database;


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
     */
    public function initDatabase(): void
    {
        $this->getFactory()->createPropelProvider()->init();
    }

    /**
     * Generate propel config from project config
     *
     * @api
     */
    public function generateConfig(): void
    {
        $this->getFactory()->createConfigGenerator()->generate();
    }

    /**
     * Build all models
     *
     * @api
     *
     * @return array
     */
    public function buildModel(): array
    {
        return $this->getFactory()->createPropelCommandProvider()->execute('model:build');
    }

    /**
     * Runs all migrations
     *
     * @api
     *
     * @return array
     */
    public function migrate(): array
    {
        $result = $this->getFactory()->createPropelCommandProvider()->execute('migration:diff');
        return array_merge(
            $result,
            $this->getFactory()->createPropelCommandProvider()->execute('migration:migrate')
        );
    }
}
