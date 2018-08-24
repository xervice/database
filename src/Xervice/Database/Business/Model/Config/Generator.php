<?php
declare(strict_types=1);


namespace Xervice\Database\Business\Model\Config;


use Xervice\Database\Business\Exception\DatabaseConfigException;
use Xervice\Database\Business\Model\Config\Converter\ConverterInterface;

class Generator implements GeneratorInterface
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var string
     */
    private $confDir;

    /**
     * @var ConverterInterface
     */
    private $converter;

    /**
     * Generator constructor.
     *
     * @param array $config
     * @param string $confDir
     * @param ConverterInterface $converter
     */
    public function __construct(array $config, string $confDir, ConverterInterface $converter)
    {
        $this->config = $config;
        $this->confDir = $confDir;
        $this->converter = $converter;
    }

    /**
     * @throws \Xervice\Database\Business\Exception\DatabaseConfigException
     */
    public function generate(): void
    {
        if (!is_dir($this->confDir)) {
            throw new DatabaseConfigException('Config path not exist: ' . $this->confDir);
        }
        file_put_contents(
            $this->confDir . '/propel.json',
            $this->converter->convert($this->config)
        );
    }
}
