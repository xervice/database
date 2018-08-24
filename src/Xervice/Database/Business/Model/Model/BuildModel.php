<?php


namespace Xervice\Database\Business\Model\Model;


use Symfony\Component\Finder\Finder;
use Xervice\Database\Business\Model\Provider\PropelCommandProviderInterface;

class BuildModel implements BuildModelInterface
{
    /**
     * @var \Xervice\Database\Business\Model\Provider\PropelCommandProviderInterface
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
     * @param \Xervice\Database\Business\Model\Provider\PropelCommandProviderInterface $propelCommandProvider
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
                $targetFilename = str_replace(
                    $this->schemaPattern,
                    '.schema.xml',
                    basename((string)$schemaFile->getRealPath())
                );
                copy((string)$schemaFile->getRealPath(), $this->schemaTarget . '/' . $targetFilename);
            }
        }

        return $this->propelCommandProvider->execute('model:build');
    }
}