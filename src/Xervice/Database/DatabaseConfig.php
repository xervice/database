<?php
declare(strict_types=1);


namespace Xervice\Database;


use Xervice\Core\Config\AbstractConfig;

class DatabaseConfig extends AbstractConfig
{
    public const PROPEL = 'propel';

    public const PROPEL_CONF_DIR = 'propel.conf.dir';

    public const PROPEL_CONF_ADAPTER = 'propel.conf.adapter';

    public const PROPEL_CONF_HOST = 'propel.conf.host';

    public const PROPEL_CONF_PORT = 'propel.conf.port';

    public const PROPEL_CONF_DBNAME = 'propel.conf.dbname';

    public const PROPEL_CONF_USER = 'propel.conf.user';

    public const PROPEL_CONF_PASSWORD = 'propel.conf.password';

    public const PROPEL_COMMAND = 'propel.command';

    /**
     * @return array
     */
    public function getPropelConfig() : array
    {
        return $this->get(self::PROPEL);
    }

    /**
     * @return string
     */
    public function getConfDir() : string
    {
        return $this->get(self::PROPEL_CONF_DIR);
    }

    /**
     * @return string
     */
    public function getPropelCommand() : string
    {
        return $this->get(self::PROPEL_COMMAND, 'vendor/bin/propel');
    }
}
