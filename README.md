Xervice: Database
==================

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/xervice/database/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/xervice/database/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/xervice/database/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/xervice/database/?branch=master)

***Default configuration***
```php
<?php

use Xervice\Database\DatabaseConfig;

$config[DatabaseConfig::PROPEL_CONF_DIR] = __DIR__;


$config[DatabaseConfig::PROPEL_CONF_ADAPTER] = 'pgsql';

$config[DatabaseConfig::PROPEL_CONF_HOST] = '127.0.0.1';
$config[DatabaseConfig::PROPEL_CONF_PORT] = '5432';
$config[DatabaseConfig::PROPEL_CONF_DBNAME] = '';
$config[DatabaseConfig::PROPEL_CONF_USER] = '';
$config[DatabaseConfig::PROPEL_CONF_PASSWORD] = '';


$dsn = sprintf(
    '%s:host=%s;port=%d;dbname=%s;user=%s;password=%s',
    $config[DatabaseConfig::PROPEL_CONF_ADAPTER],
    $config[DatabaseConfig::PROPEL_CONF_HOST] ,
    $config[DatabaseConfig::PROPEL_CONF_PORT],
    $config[DatabaseConfig::PROPEL_CONF_DBNAME],
    $config[DatabaseConfig::PROPEL_CONF_USER],
    $config[DatabaseConfig::PROPEL_CONF_PASSWORD]
);

$config[DatabaseConfig::PROPEL] = [
    'propel' => [
        'database'  => [
            'connections' => [
                'default' => [
                    'adapter'    => $config[DatabaseConfig::PROPEL_CONF_ADAPTER],
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => $dsn,
                    'user'       => $config[DatabaseConfig::PROPEL_CONF_USER],
                    'password'   => $config[DatabaseConfig::PROPEL_CONF_PASSWORD],
                    'attributes' => [
                        'ATTR_EMULATE_PREPARES' => false,
                        'ATTR_TIMEOUT'          => 30,
                    ]
                ]
            ],
        ],
        'runtime'   => [
            'defaultConnection' => 'default',
            'connections'       => ['default']
        ],
        'generator' => [
            'defaultConnection' => 'default',
            'connections'       => ['default'],
            'recursive'         => true
        ],
        'paths'     => [
            'projectDir'   => dirname(__DIR__),
            'schemaDir'    => dirname(__DIR__) . '/src',
            'outputDir'    => dirname(__DIR__) . '/src/Orm/Output',
            'phpDir'       => dirname(__DIR__) . '/src/',
            'migrationDir' => dirname(__DIR__) . '/src/Orm/Migrations',
            'phpConfDir'   => dirname(__DIR__) . '/src/Orm/Config',
            'sqlDir'       => dirname(__DIR__) . '/src/Orm/Sql'
        ]
    ]
];
```

If you want to use a query container class, you can add the DatabaseHelper to the core module helper list.
After that you cann create a class "MyModuleQueryContainer" in your module root. The class must implement the QueryContainerInterface.
You can add that class in your dependency provider by getting it from the locator.