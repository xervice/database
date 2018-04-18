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

    /**
     * @group Xervice
     * @group Database
     * @group Facade
     *
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \Xervice\Config\Exception\ConfigNotFound
     * @throws \Xervice\Config\Exception\FileNotFound
     */
    public function testGenerate()
    {
        $this->getFacade()->generateConfig();
        $this->assertTrue(file_exists(XerviceConfig::getInstance()->getConfig()->get(DatabaseConfig::PROPEL_CONF_DIR) . '/propel.json'));
    }

    /**
     * @group Xervice
     * @group Database
     * @group Facade
     *
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \Xervice\Config\Exception\ConfigNotFound
     * @throws \Xervice\Config\Exception\FileNotFound
     */
    public function testBuildModel()
    {
        $this->getFacade()->buildModel();
        $this->assertTrue(is_dir(XerviceConfig::getInstance()->getConfig()->get(DatabaseConfig::PROPEL)['propel']['paths']['phpDir'] . '/Orm/Xervice/Database'));

        $version = new VersionQuery();
        $this->assertInstanceOf(VersionQuery::class, $version);


    }

    /**
     * @group Xervice
     * @group Database
     * @group Facade
     *
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function testMigrate()
    {
        $this->getFacade()->migrate();
    }

    /**
     * @group Xervice
     * @group Database
     * @group Facade
     *
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function testSaveVersion()
    {
        $this->getFacade()->initDatabase();

        $query = VersionQuery::create();
        $query->setDbName(null);
        $versions = $query->findByVersion('test');
        if ($versions->count() > 0) {
            foreach ($versions as $version) {
                $version->delete();
            }
        }

        $version = new Version();
        $version->setVersion('test');
        $version->save();

        $newId = $version->getId();

        $newVersion = $query->findOneById($newId);
        $this->assertEquals(
            $newId,
            $newVersion->getId()
        );
    }
}