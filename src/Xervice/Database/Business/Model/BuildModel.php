<?php


namespace Xervice\Database\Business\Model;


use Symfony\Component\Finder\Finder;
use Xervice\Database\Provider\PropelCommandProviderInterface;

class BuildModel implements BuildModelInterface
{
    /**
     * @var \Xervice\Database\Provider\PropelCommandProviderInterface
     */
    private $propelCommandProvider;

    /**
     * @var array
     */
    private $schemaPaths;

    /**
     * @var string
     */
    private $schemaTarget;

    /**
     * BuildModel constructor.
     *
     * @param \Xervice\Database\Provider\PropelCommandProviderInterface $propelCommandProvider
     * @param array $schemaPaths
     */
    public function __construct(
        PropelCommandProviderInterface $propelCommandProvider,
        array $schemaPaths,
        string $schemaTarget
    ) {
        $this->propelCommandProvider = $propelCommandProvider;
        $this->schemaPaths = $schemaPaths;
        $this->schemaTarget = $schemaTarget;
    }

    /**
     * @return array
     */
    public function buildModel(): array
    {
        if (!is_dir($this->schemaTarget)) {
            if (!mkdir($this->schemaTarget, 0777) && !is_dir($this->schemaTarget)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $this->schemaTarget));
            }
        }

        foreach ($this->schemaPaths as $schemaPath) {
            $finder = new Finder();
            $finder->files()->name('*.schema.xml')->in($schemaPath);
            foreach ($finder as $schemaFile) {
                copy($schemaFile->getRealPath(), $this->schemaTarget . '/' . basename($schemaFile->getRealPath()));
            }
        }

        return $this->propelCommandProvider->execute('model:build');
    }
}