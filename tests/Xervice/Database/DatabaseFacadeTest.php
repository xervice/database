<?php
namespace XerviceTest\Database;

use Orm\Xervice\Database\Persistence\Version;
use Orm\Xervice\Database\Persistence\VersionQuery;
use Xervice\Config\XerviceConfig;
use Xervice\Core\Locator\Dynamic\DynamicLocator;
use Xervice\Database\DatabaseConfig;

/**
 * @method \Xervice\Database\DatabaseFacade getFacade()
 */
class DatabaseFacadeTest extends \Codeception\Test\Unit
{
    use DynamicLocator;

    /**
     * @var \XerviceTest\XerviceTester
     */
    protected $tester;

    // tests
    public function testGenerate()
    {
        $this->getFacade()->generateConfig();
        $this->assertTrue(file_exists(XerviceConfig::getInstance()->getConfig()->get(DatabaseConfig::PROPEL_CONF_DIR) . '/propel.json'));
    }

    /**
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \Xervice\Config\Exception\ConfigNotFound
     * @throws \Xervice\Config\Exception\FileNotFound
     */
    public function testConvert()
    {
        $confFile = XerviceConfig::getInstance()->getConfig()->get(DatabaseConfig::PROPEL)['propel']['paths']['phpConfDir'] . '/config.php';

        if (is_file($confFile)) {
            unlink($confFile);
        }
        $this->getFacade()->convertConfig();
        $this->assertTrue(is_file($confFile));
    }

    /**
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function testBuildModel()
    {
        $this->getFacade()->buildModel();
        $this->assertTrue(is_dir(XerviceConfig::getInstance()->getConfig()->get(DatabaseConfig::PROPEL)['propel']['paths']['phpDir'] . '/Orm/Xervice/Database'));

        $version = new VersionQuery();
        $this->assertInstanceOf(VersionQuery::class, $version);


    }

    /**
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function testMigrate()
    {
        $this->getFacade()->migrate();
    }

    public function testSaveVersion()
    {
        require $confFile = XerviceConfig::getInstance()->getConfig()->get(DatabaseConfig::PROPEL)['propel']['paths']['phpConfDir'] . '/config.php';

        $query = VersionQuery::create();
        $query->setDbName(null);
        $version = $query->findById(1);
        if ($version) {
            $version->delete();
        }

        $version = new Version();
        $version->setVersion('test');
        $version->save();
    }
}