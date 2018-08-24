<?php
declare(strict_types=1);

namespace Xervice\Database\Business;

use Xervice\Core\Business\Model\Facade\AbstractFacade;

/**
 * @method \Xervice\Database\Business\DatabaseBusinessFactory getFactory()
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

    /**git tag
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
        return $this->getFactory()->createBuildModel()->buildModel();
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
