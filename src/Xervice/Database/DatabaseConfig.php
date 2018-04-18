<?php


namespace Xervice\Database;


use Xervice\Core\Config\AbstractConfig;

class DatabaseConfig extends AbstractConfig
{
    const PROPEL = 'propel';

    const PROPEL_CONF_DIR = 'propel.conf.dir';

    const PROPEL_CONF_ADAPTER = 'propel.conf.adapter';

    const PROPEL_CONF_HOST = 'propel.conf.host';

    const PROPEL_CONF_PORT = 'propel.conf.port';

    const PROPEL_CONF_DBNAME = 'propel.conf.dbname';

    const PROPEL_CONF_USER = 'propel.conf.user';

    const PROPEL_CONF_PASSWORD = 'propel.conf.password';

    const PROPEL_COMMAND = 'propel.command';

    /**
     * @return array
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function getPropelConfig() : array
    {
        return $this->get(self::PROPEL);
    }

    /**
     * @return string
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function getConfDir() : string
    {
        return $this->get(self::PROPEL_CONF_DIR);
    }

    /**
     * @return string
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function getPropelCommand() : string
    {
        return $this->get(self::PROPEL_COMMAND, 'vendor/bin/propel');
    }
}