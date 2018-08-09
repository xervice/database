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
     * @var string
     */
    private $schemaPattern;

    /**
     * BuildModel constructor.
     *
     * @param \Xervice\Database\Provider\PropelCommandProviderInterface $propelCommandProvider
     * @param array $schemaPaths
     */
    public function __construct(
        PropelCommandProviderInterface $propelCommandProvider,
        array $schemaPaths,
        string $schemaTarget,
        string $schemaPattern
    ) {
        $this->propelCommandProvider = $propelCommandProvider;
        $this->schemaPaths = $schemaPaths;
        $this->schemaTarget = $schemaTarget;
        $this->schemaPattern = $schemaPattern;
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
            $finder->files()->name('*' . $this->schemaPattern)->in($schemaPath);
            foreach ($finder as $schemaFile) {
                $targetFilename = str_replace($this->schemaPattern, '.schema.xml', basename($schemaFile->getRealPath()));
                copy($schemaFile->getRealPath(), $this->schemaTarget . '/' . $targetFilename);
            }
        }

        return $this->propelCommandProvider->execute('model:build');
    }
}